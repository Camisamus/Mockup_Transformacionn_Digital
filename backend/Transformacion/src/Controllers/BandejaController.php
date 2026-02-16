<?php
namespace App\Controllers;

use PDO;

class BandejaController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getInbox(int $userId): array
    {
        // 1. We no longer need to map Rut to a different table. 
        // The userId (usr_id) is the same as sol_funcionario_id now.
        $funcionarioId = $userId;

        $results = [];

        // 3. Query 1: DESVE Solicitudes
        $desveSql = "SELECT DISTINCT
                            sol.sol_id as id, 
                            sol.sol_nombre_expediente as asunto, 
                            sol.sol_fecha_recepcion as fecha,
                            sol.sol_fecha_vencimiento as fecha_limite,
                            'DESVE' as origen,
                            'Pendiente' as estado,
                            CASE 
                                WHEN sol.sol_responsable = :fid_owner THEN 'Responsable'
                                ELSE 'Destino'
                            END as rol_usuario
                        FROM trd_desve_solicitudes sol
                        LEFT JOIN trd_desve_destinos dest ON sol.sol_id = dest.tid_desve_solicitud AND dest.tid_destino = :fid
                        WHERE (sol.sol_responsable = :fid_owner2 OR dest.tid_destino IS NOT NULL)
                        AND sol.sol_borrado = 0 
                        AND sol.sol_estado_entrega = 0";

        $stmt1 = $this->db->prepare($desveSql);
        $stmt1->bindParam(':fid', $funcionarioId);
        $stmt1->bindParam(':fid_owner', $funcionarioId);
        $stmt1->bindParam(':fid_owner2', $funcionarioId);
        $stmt1->execute();
        $desve = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // 4. Query 2: Ingresos Solicitudes (where user is a destination OR owner)
        $ingresosSql = "SELECT DISTINCT
                            sol.tis_id as id, 
                            sol.tis_titulo as asunto, 
                            sol.tis_fecha as fecha,
                            sol.tis_fecha_limite as fecha_limite,
                            'Ingresos' as origen,
                            sol.tis_estado as estado,
                            CASE 
                                WHEN sol.tis_responsable = :fid_owner THEN 'Responsable'
                                WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                                ELSE 'Consultor' 
                            END as rol_usuario
                        FROM trd_ingresos_solicitudes sol
                        LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :fid
                        WHERE (sol.tis_responsable = :fid_owner1 OR dest.tid_destino IS NOT NULL)
                        AND sol.tis_estado NOT IN ('Resuelto_Favorable', 'Resuelto_NO_Favorable')
                        AND (
                            dest.tid_facultad IN ('Visador', 'Consultor')
                            OR NOT EXISTS (
                                SELECT 1 FROM trd_ingresos_destinos d2 
                                WHERE d2.tid_ingreso_solicitud = sol.tis_id 
                                AND d2.tid_facultad = 'Visador' 
                                AND d2.tid_requeido = 1 
                                AND (d2.tid_responde IS NULL OR d2.tid_responde != 1)
                            )
                        )";

        $stmt2 = $this->db->prepare($ingresosSql);
        $stmt2->bindParam(':fid', $funcionarioId);
        $stmt2->bindParam(':fid_owner', $funcionarioId);
        $stmt2->bindParam(':fid_owner1', $funcionarioId);
        $stmt2->execute();
        $ingresos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // 5. Query 3: Tareas
        $tareasSql = "SELECT 
                            sol.tar_id as id, 
                            sol.tar_titulo as asunto, 
                            sol.tar_detalle as detalle,
                            sol.tar_fecha_creacion as fecha,
                            sol.tar_plazo as fecha_limite,
                            'TAREAS' as origen,
                            'Pendiente' as estado,
                            'Responsable' as rol_usuario
                        FROM trd_tareas sol
                        WHERE sol.tar_asignado = :fid AND sol.tar_estado = 0";

        $stmt3 = $this->db->prepare($tareasSql);
        $stmt3->bindParam(':fid', $funcionarioId);
        $stmt3->execute();
        $tareas = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        // Merge results
        $results = array_merge($desve, $ingresos, $tareas);

        // Date Formatting
        if (!class_exists('App\Helpers\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        foreach ($results as &$item) {
            if (isset($item['fecha'])) {
                $item['fecha_original'] = $item['fecha']; // Keep original for sorting
                $item['fecha'] = \App\Helpers\Fechas::formatearFecha($item['fecha']);
            }
            if (isset($item['fecha_limite'])) {
                $item['fecha_limite'] = \App\Helpers\Fechas::formatearFecha($item['fecha_limite']);
            }
        }

        // Sort by original date descending
        usort($results, function ($a, $b) {
            $dateA = $a['fecha_original'] ?? '';
            $dateB = $b['fecha_original'] ?? '';
            return strcmp($dateB, $dateA);
        });

        return $results;
    }

    public function getHistorial(int $userId, ?string $fechaInicio = null, ?string $fechaFin = null): array
    {
        // Default to last 30 days if no dates provided
        if (!$fechaInicio) {
            $fechaInicio = date('Y-m-d', strtotime('-30 days'));
        }
        if (!$fechaFin) {
            $fechaFin = date('Y-m-d');
        }

        $funcionarioId = $userId;
        $results = [];

        // 1. Query: DESVE Solicitudes Cerradas
        $desveSql = "SELECT DISTINCT
                            sol.sol_id as id, 
                            sol.sol_nombre_expediente as asunto, 
                            sol.sol_fecha_recepcion as fecha,
                            sol.sol_fecha_respuesta_coordinador as fecha_cierre,
                            'DESVE' as origen,
                            'Cerrado' as estado,
                            CASE 
                                WHEN sol.sol_responsable = :fid_owner THEN 'Responsable'
                                ELSE 'Destino'
                            END as rol_usuario
                        FROM trd_desve_solicitudes sol
                        LEFT JOIN trd_desve_destinos dest ON sol.sol_id = dest.tid_desve_solicitud AND dest.tid_destino = :fid
                        WHERE (sol.sol_responsable = :fid_owner2 OR dest.tid_destino IS NOT NULL)
                        AND sol.sol_borrado = 0 
                        AND sol.sol_estado_entrega = 1
                        AND DATE(sol.sol_fecha_recepcion) >= :fecha_inicio_desve
                        AND DATE(sol.sol_fecha_recepcion) <= :fecha_fin_desve";

        $stmt1 = $this->db->prepare($desveSql);
        $stmt1->bindParam(':fid', $funcionarioId);
        $stmt1->bindParam(':fid_owner', $funcionarioId);
        $stmt1->bindParam(':fid_owner2', $funcionarioId);
        $stmt1->bindParam(':fecha_inicio_desve', $fechaInicio);
        $stmt1->bindParam(':fecha_fin_desve', $fechaFin);
        $stmt1->execute();
        $desve = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // 2. Query: Ingresos Solicitudes Cerradas
        $ingresosSql = "SELECT DISTINCT
                            sol.tis_id as id, 
                            sol.tis_titulo as asunto, 
                            sol.tis_fecha as fecha,
                            sol.tis_fecha_limite as fecha_cierre,
                            'Ingresos' as origen,
                            sol.tis_estado as estado,
                            CASE 
                                WHEN sol.tis_responsable = :fid_owner THEN 'Responsable'
                                WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                                ELSE 'Consultor' 
                            END as rol_usuario
                        FROM trd_ingresos_solicitudes sol
                        LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :fid
                        WHERE (sol.tis_responsable = :fid_owner1 OR dest.tid_destino IS NOT NULL)
                        AND sol.tis_estado IN ('Resuelto_Favorable', 'Resuelto_NO_Favorable')
                        AND DATE(sol.tis_fecha) >= :fecha_inicio_ingr
                        AND DATE(sol.tis_fecha) <= :fecha_fin_ingr";

        $stmt2 = $this->db->prepare($ingresosSql);
        $stmt2->bindParam(':fid', $funcionarioId);
        $stmt2->bindParam(':fid_owner', $funcionarioId);
        $stmt2->bindParam(':fid_owner1', $funcionarioId);
        $stmt2->bindParam(':fecha_inicio_ingr', $fechaInicio);
        $stmt2->bindParam(':fecha_fin_ingr', $fechaFin);
        $stmt2->execute();
        $ingresos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // 3. Query: Tareas Completadas
        $tareasSql = "SELECT 
                            sol.tar_id as id, 
                            sol.tar_titulo as asunto, 
                            sol.tar_detalle as detalle,
                            sol.tar_fecha_creacion as fecha,
                            sol.tar_plazo as fecha_cierre,
                            'TAREAS' as origen,
                            'Completada' as estado,
                            'Responsable' as rol_usuario
                        FROM trd_tareas sol
                        WHERE sol.tar_asignado = :fid 
                        AND sol.tar_estado = 1
                        AND DATE(sol.tar_fecha_creacion) >= :fecha_inicio_tar
                        AND DATE(sol.tar_fecha_creacion) <= :fecha_fin_tar";

        $stmt3 = $this->db->prepare($tareasSql);
        $stmt3->bindParam(':fid', $funcionarioId);
        $stmt3->bindParam(':fecha_inicio_tar', $fechaInicio);
        $stmt3->bindParam(':fecha_fin_tar', $fechaFin);
        $stmt3->execute();
        $tareas = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        // Merge results
        $results = array_merge($desve, $ingresos, $tareas);

        // Date Formatting
        if (!class_exists('App\\Helpers\\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        foreach ($results as &$item) {
            if (isset($item['fecha'])) {
                $item['fecha_original'] = $item['fecha'];
                $item['fecha'] = \App\Helpers\Fechas::formatearFecha($item['fecha']);
            }
            if (isset($item['fecha_cierre'])) {
                $item['fecha_cierre'] = \App\Helpers\Fechas::formatearFecha($item['fecha_cierre']);
            }
        }

        // Sort by original date descending
        usort($results, function ($a, $b) {
            $dateA = $a['fecha_original'] ?? '';
            $dateB = $b['fecha_original'] ?? '';
            return strcmp($dateB, $dateA);
        });

        return $results;
    }
}
