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
                            '-' as fecha_limite,
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
}
