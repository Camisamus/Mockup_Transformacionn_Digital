<?php
namespace App\Models;

use PDO;
use Exception;

class oirs_gestiones
{
    private $conn;
    private $table_name = "trd_oirs_gestion";
    private $table_name_parent = "trd_general_registro_general_expedientes";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new general_bitacora($db);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            oig_solicitud = :solicitud_id,
            oig_asignacion = :asignacion,
            oig_respuesta_preliminar = :respuesta_preliminar,
            oig_requiere_respuesta_tecnica = :requiere_tecnica,
            oig_respuesta_tecnica = :respuesta_tecnica,
            oig_solicitud_ejecutada = :ejecutada,
            oig_fuente_financiamiento = :fuente,
            oig_notificacion_ejecucion = :notificacion,
            oig_realizada_en_plazo = :en_plazo,
            oig_aclaratoria_contribuyente = :aclaratoria_cont,
            oig_respuesta_aclaratoria = :resp_aclaratoria";

        $stmt = $this->conn->prepare($query);

        $params = [
            ":solicitud_id" => $data['oig_solicitud'],
            ":asignacion" => $data['oig_asignacion'] ?? null,
            ":respuesta_preliminar" => $data['oig_respuesta_preliminar'] ?? null,
            ":requiere_tecnica" => $data['oig_requiere_respuesta_tecnica'] ?? null,
            ":respuesta_tecnica" => $data['oig_respuesta_tecnica'] ?? null,
            ":ejecutada" => $data['oig_solicitud_ejecutada'] ?? null,
            ":fuente" => $data['oig_fuente_financiamiento'] ?? null,
            ":notificacion" => $data['oig_notificacion_ejecucion'] ?? null,
            ":en_plazo" => $data['oig_realizada_en_plazo'] ?? null,
            ":aclaratoria_cont" => $data['oig_aclaratoria_contribuyente'] ?? null,
            ":resp_aclaratoria" => $data['oig_respuesta_aclaratoria'] ?? null
        ];

        $this->logQuery($query, $params);

        if ($stmt->execute($params)) {
            // Log en Bitácora si hay respuesta preliminar
            if (!empty($data['oig_respuesta_preliminar'])) {
                try {
                    $query_sol = "SELECT oirs_registro_tramite FROM trd_oirs_solicitud WHERE oirs_id = :id LIMIT 1";
                    $stmt_sol = $this->conn->prepare($query_sol);
                    $stmt_sol->bindParam(":id", $data['oig_solicitud']);
                    $stmt_sol->execute();
                    $solicitud = $stmt_sol->fetch(PDO::FETCH_ASSOC);

                    if ($solicitud && $solicitud['oirs_registro_tramite']) {
                        $this->bitacora->registrar($solicitud['oirs_registro_tramite'], "Ingresa gestión OIRS (Respuesta inmediata)", $data['creador_id'] ?? 1);
                    }
                } catch (Exception $e) {
                    error_log("Error logging OIRS gestion in Bitacora: " . $e->getMessage());
                }
            }
            return true;
        }
        return false;
    }

    public function update($solicitud_id, $data)
    {
        $fields = [];
        $params = [":solicitud_id" => $solicitud_id];

        foreach ($data as $key => $value) {
            if ($key !== 'oig_solicitud' && $key !== 'creador_id' && $key !== 'ACCION') {
                $fields[] = "$key = :$key";
                $params[":$key"] = $value;
            }
        }

        if (empty($fields))
            return true;

        $query = "UPDATE " . $this->table_name . " SET " . implode(", ", $fields) . " WHERE oig_solicitud = :solicitud_id";
        $stmt = $this->conn->prepare($query);

        $this->logQuery($query, $params);

        if ($stmt->execute($params)) {
            // Log en Bitácora según lo que se actualizó
            try {
                $query_sol = "SELECT oirs_registro_tramite FROM trd_oirs_solicitud WHERE oirs_id = :id LIMIT 1";
                $stmt_sol = $this->conn->prepare($query_sol);
                $stmt_sol->bindParam(":id", $solicitud_id);
                $stmt_sol->execute();
                $solicitud = $stmt_sol->fetch(PDO::FETCH_ASSOC);

                if ($solicitud && $solicitud['oirs_registro_tramite']) {
                    $rgt_id = $solicitud['oirs_registro_tramite'];
                    $user_id = $data['creador_id'] ?? $_SESSION['user_id'] ?? 1;

                    if (isset($data['oig_asignacion'])) {
                        $this->bitacora->registrar($rgt_id, "Asignación de OIRS a: " . $data['oig_asignacion'], $user_id);
                    }
                    if (isset($data['oig_respuesta_preliminar'])) {
                        $this->bitacora->registrar($rgt_id, "Ingresa respuesta preliminar OIRS", $user_id);
                    }
                    if (isset($data['oig_respuesta_tecnica'])) {
                        $this->bitacora->registrar($rgt_id, "Ingresa respuesta técnica OIRS", $user_id);
                    }
                    if (isset($data['oig_notificacion_ejecucion'])) {
                        $this->bitacora->registrar($rgt_id, "Notificación de ejecución OIRS enviada", $user_id);
                    }
                    if (isset($data['oig_respuesta_aclaratoria'])) {
                        $this->bitacora->registrar($rgt_id, "Ingresa respuesta a aclaratoria", $user_id);
                    }
                }
            } catch (Exception $e) {
                error_log("Error logging OIRS update in Bitacora: " . $e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function getBySolicitudId($solicitud_id)
    {
        $query = "SELECT g.*, 
                  CONCAT(up.usr_nombre, ' ', up.usr_apellido) as oig_res_pre_origen_nombre,
                  CONCAT(ut.usr_nombre, ' ', ut.usr_apellido) as oig_res_tec_origen_nombre,
                  CONCAT(un.usr_nombre, ' ', un.usr_apellido) as oig_res_not_origen_nombre
                  FROM " . $this->table_name . " g
                  LEFT JOIN trd_acceso_usuarios up ON g.oig_res_pre_origen = up.usr_id
                  LEFT JOIN trd_acceso_usuarios ut ON g.oig_res_tec_origen = ut.usr_id
                  LEFT JOIN trd_acceso_usuarios un ON g.oig_res_not_origen = un.usr_id
                  WHERE g.oig_solicitud = :solicitud_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":solicitud_id", $solicitud_id);

        $this->logQuery($query, [":solicitud_id" => $solicitud_id]);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Obtiene solicitudes OIRS según la vista y el usuario
     * 
     * @param int $userId ID del usuario actual
     * @param string $view Vista solicitada (bandeja, listar, revisar, visar, historial)
     * @param array $filters Filtros adicionales opcionales
     * @return array
     */
    public function getOirsByView($userId, $view, $filters = [])
    {
        // 1. Identificar Perfil OIRS del usuario activo
        $perfilSql = "SELECT ofa_area, ofa_p FROM trd_oirs_funcionarios_areas 
                      WHERE ofa_funcionario = :userId AND (ofa_borrado = 0 OR ofa_borrado IS NULL) LIMIT 1";
        $pStmt = $this->conn->prepare($perfilSql);
        $pStmt->bindValue(':userId', $userId);

        $this->logQuery($perfilSql, [':userId' => $userId]);

        $this->logQuery("Vista: " . $view, "");


        $pStmt->execute();
        $perfil = $pStmt->fetch(PDO::FETCH_ASSOC);

        $esAdminOirs = ($perfil && $perfil['ofa_area'] == 2); // Area 2 = OIRS

        // Base Query - Updated to join with parent table (tramite) and contributor
        // Se une con trd_oirs_funcionarios_cargos para validar si el usuario actual ocupa el cargo asignado
        $query = "SELECT s.*, 
                         s.oirs_creacion as oirs_fecha_ingreso,
                         r.rgt_creador, r.rgt_id_publica as folio,
                         t.oig_asignacion, t.oig_solicitud_ejecutada,
                         CONCAT(tgc.tgc_nombre, ' ', tgc.tgc_apellido_paterno, ' ', tgc.tgc_apellido_materno) as nombre_contribuyente,
                         tgc.tgc_rut as rut_contribuyente,
                         tem.tem_nombre as oirs_tematica_nombre,
                         sub.sub_nombre as oirs_subtematica_nombre
                  FROM trd_oirs_solicitud s
                  JOIN " . $this->table_name_parent . " r ON s.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_gestion t ON s.oirs_id = t.oig_solicitud AND t.oig_borrado = 0
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id AND tgc.tgc_borrado = 0
                  LEFT JOIN trd_oirs_tematicas tem ON s.oirs_tematica = tem.tem_id AND tem.tem_borrado = 0
                  LEFT JOIN trd_oirs_subtematicas sub ON s.oirs_subtematica = sub.sub_id AND sub.sub_borrado = 0
                  LEFT JOIN trd_oirs_asignaciones a ON s.oirs_id = a.oia_solicitud AND a.oia_borrado = 0
                  LEFT JOIN trd_oirs_funcionarios_cargos fc ON a.oia_asignacion = fc.ofc_cargo 
                    AND fc.ofc_funcionario = :userId 
                    AND fc.ofc_estado = 1 
                    AND fc.ofc_desde <= NOW() 
                    AND (fc.ofc_hasta IS NULL OR fc.ofc_hasta >= NOW())";

        $query .= " WHERE s.oirs_borrado = 0 AND r.rgt_borrado = 0";


        switch ($view) {
            case 'bandeja':
                // Creado por usuario O asignado a su cargo actual
                $query .= " AND (r.rgt_creador = :u1 OR fc.ofc_id IS NOT NULL) 
                            AND s.oirs_estado < 2";
                break;

            case 'listar':
                // Soy el creador
                $query .= " AND r.rgt_creador = :u1";
                break;

            case 'por_revisar':
                // Si es Admin OIRS ve todas las nuevas (estado 0)
                // Si no, solo las que tiene asignadas su cargo
                if (!$esAdminOirs) {
                    $query .= " AND fc.ofc_id IS NOT NULL";
                }
                $query .= " AND s.oirs_estado = 0";
                break;

            case 'visar':
                // Asignadas a mi cargo y en estado 0
                $query .= " AND fc.ofc_id IS NOT NULL 
                            AND s.oirs_estado = 0";
                break;

            case 'historial':
                // Finalizadas (estado > 3)
                if (!$esAdminOirs) {
                    $query .= " AND (r.rgt_creador = :u1 OR fc.ofc_id IS NOT NULL)";
                }
                $query .= " AND s.oirs_estado > 3";
                break;

            default:
                return [];
        }

        $query .= " ORDER BY s.oirs_creacion DESC";

        $params = [];
        // Soporta múltiples variantes de nombres de parámetros para mayor compatibilidad
        foreach ([':userId', ':userid', ':u1', ':u2', ':u_join'] as $p) {
            if (strpos($query, $p) !== false) {
                $params[$p] = $userId;
            }
        }

        try {
            $stmt = $this->conn->prepare($query);

            $this->logQuery($query, $params);

            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Log error for debugging API
            error_log("OIRS_Gestion::getOirsByView Error: " . $e->getMessage());
            throw $e;
        }

        // Post-processing
        foreach ($results as &$row) {
            $row['es_dueno'] = ($row['rgt_creador'] == $userId);
            // Ensure subject/asunto is available
            $row['oirs_asunto'] = $row['oirs_tematica_nombre'] ?? $row['oirs_descripcion'] ?? 'Sin asunto';
        }

        return $results;
    }

    private function logQuery($query, $params = [])
    {
        try {
            $logFile = __DIR__ . "/../../logs_oirs_queries.txt";
            $date = date('Y-m-d H:i:s');
            // Clean up query newlines and extra spaces for one-line log
            $cleanQuery = preg_replace('/\s+/', ' ', trim($query));
            $paramsStr = !empty($params) ? " | Params: " . json_encode($params) : "";
            $message = "[$date] $cleanQuery$paramsStr" . PHP_EOL . "---" . PHP_EOL;
            file_put_contents($logFile, $message, FILE_APPEND);
        } catch (Exception $e) {
            error_log("OIRS_Gestion::logQuery Error: " . $e->getMessage());
        }
    }
}
