<?php
namespace App\Models;

use PDO;
use Exception;

class OIRS_Gestion
{
    private $conn;
    private $table_name = "trd_oirs_gestion";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
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

        $stmt->bindValue(":solicitud_id", $data['oig_solicitud']);
        $stmt->bindValue(":asignacion", $data['oig_asignacion'] ?? null);
        $stmt->bindValue(":respuesta_preliminar", $data['oig_respuesta_preliminar'] ?? null);
        $stmt->bindValue(":requiere_tecnica", $data['oig_requiere_respuesta_tecnica'] ?? null);
        $stmt->bindValue(":respuesta_tecnica", $data['oig_respuesta_tecnica'] ?? null);
        $stmt->bindValue(":ejecutada", $data['oig_solicitud_ejecutada'] ?? null);
        $stmt->bindValue(":fuente", $data['oig_fuente_financiamiento'] ?? null);
        $stmt->bindValue(":notificacion", $data['oig_notificacion_ejecucion'] ?? null);
        $stmt->bindValue(":en_plazo", $data['oig_realizada_en_plazo'] ?? null);
        $stmt->bindValue(":aclaratoria_cont", $data['oig_aclaratoria_contribuyente'] ?? null);
        $stmt->bindValue(":resp_aclaratoria", $data['oig_respuesta_aclaratoria'] ?? null);

        if ($stmt->execute()) {
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE oig_solicitud = :solicitud_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":solicitud_id", $solicitud_id);
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
        // Base Query - Updated to join with parent table (tramite) and contributor
        $query = "SELECT s.*, 
                         s.oirs_fecha_hora as oirs_fecha_ingreso,
                         r.rgt_creador, r.rgt_id_publica as folio,
                         t.oig_asignacion, t.oig_solicitud_ejecutada,
                         CONCAT(tgc.tgc_nombre, ' ', tgc.tgc_apellido_paterno, ' ', tgc.tgc_apellido_materno) as nombre_contribuyente,
                         tgc.tgc_rut as rut_contribuyente,
                         tem.tem_nombre as oirs_tematica_nombre
                  FROM trd_oirs_solicitud s
                  JOIN trd_general_registro_general_tramites r ON s.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_gestion t ON s.oirs_id = t.oig_solicitud
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  LEFT JOIN trd_oirs_tematicas tem ON s.oirs_tematica = tem.tem_id
                  LEFT JOIN trd_oirs_asignaciones a ON s.oirs_id = a.oia_solicitud AND a.oia_asignacion = :userId
                  WHERE 1=1";

        $params = [':userId' => $userId];

        switch ($view) {
            case 'bandeja':
                // (Created by User OR Assigned) AND State < 2
                $query .= " AND (r.rgt_creador = :userId OR a.oia_asignacion = :userId) 
                            AND s.oirs_estado < 2";
                break;

            case 'listar':
                // Created by User (Owner) AND State IN (0, 1, 2)
                $query .= " AND r.rgt_creador = :userId 
                            AND s.oirs_estado IN (0, 1, 2)";
                break;

            case 'revisar':
                // Assigned to User AND State = 1
                $query .= " AND a.oia_asignacion = :userId 
                            AND s.oirs_estado = 1";
                break;

            case 'visar':
                // Assigned to User AND State = 0.
                // Note: Original requirement mentioned 'assignment level 1'. 
                // We keep it simple for now as per specific request updates.
                $query .= " AND a.oia_asignacion = :userId 
                            AND s.oirs_estado = 0";
                break;

            case 'historial':
                // (Created OR Assigned) AND State > 3 (4 or 5)
                $query .= " AND (r.rgt_creador = :userId OR a.oia_asignacion = :userId) 
                            AND s.oirs_estado > 3";
                break;

            default:
                return [];
        }

        $query .= " ORDER BY s.oirs_fecha_hora DESC";

        try {
            $stmt = $this->conn->prepare($query);
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
}
