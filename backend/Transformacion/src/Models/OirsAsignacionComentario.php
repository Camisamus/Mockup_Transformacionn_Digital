<?php
namespace App\Models;

use PDO;
use Exception;

class OirsAsignacionComentario
{
    private $conn;
    private $table_name = "tdr_OIRS_asignaciones_comentarios";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    /**
     * Obtiene todos los comentarios de una asignación específica
     */
    public function obtenerPorAsignacion($asignacion_id)
    {
        $query = "SELECT c.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " c
                  LEFT JOIN trd_acceso_usuarios u ON c.oac_emisor = u.usr_id
                  WHERE c.oac_asignacion = :asignacion_id AND c.oac_borrado = 0
                  ORDER BY c.oac_creacion ASC";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":asignacion_id", $asignacion_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en OirsAsignacionComentario::obtenerPorAsignacion: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Crea un nuevo comentario en la interacción
     * oac_marcado: 0 = Comentario normal, 1 = Aprobado, 2 = Solicitar Corrección
     */
    public function crear($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
                  oac_asignacion = :asignacion_id,
                  oac_emisor = :emisor_id,
                  oac_mensaje = :mensaje,
                  oac_marcado = :marcado,
                  oac_creacion = NOW()";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":asignacion_id", $data['oac_asignacion']);
            $stmt->bindValue(":emisor_id", $data['oac_emisor']);
            $stmt->bindValue(":mensaje", $data['oac_mensaje']);
            $stmt->bindValue(":marcado", $data['oac_marcado'] ?? 0);

            if ($stmt->execute()) {
                // Registrar en bitácora si es una acción marcada
                $accion = "Comentario en asignación OIRS";
                if (isset($data['oac_marcado'])) {
                    if ($data['oac_marcado'] == 1) $accion = "Aprueba respuesta en asignación OIRS";
                    if ($data['oac_marcado'] == 2) $accion = "Solicita corrección en asignación OIRS";
                }
                
                // Intentar obtener el trámite para el log
                $this->registrarBitacora($data['oac_asignacion'], $accion, $data['oac_emisor']);
                
                return $this->conn->lastInsertId();
            }
        } catch (Exception $e) {
            error_log("Error en OirsAsignacionComentario::crear: " . $e->getMessage());
        }
        return false;
    }

    private function registrarBitacora($asignacion_id, $accion, $user_id)
    {
        try {
            $query = "SELECT s.oirs_registro_tramite 
                      FROM trd_oirs_asignaciones a
                      JOIN trd_oirs_solicitud s ON a.oia_solicitud = s.oirs_id
                      WHERE a.oia_id = :asg_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":asg_id", $asignacion_id);
            $stmt->execute();
            $res = $stmt->fetch();
            if ($res && $res['oirs_registro_tramite']) {
                $this->bitacora->registrar($res['oirs_registro_tramite'], $accion, $user_id);
            }
        } catch (Exception $e) {
            // Silently fail logging
        }
    }
}
