<?php
namespace App\Models;

use PDO;
use Exception;

class oirs_asignacion_comentarios
{
    private $conn;
    private $table_name = "trd_oirs_asignaciones_comentarios";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new general_bitacora($db);
    }

    /**
     * Obtiene todos los comentarios de una asignación específica
     */
    public function obtenerPorAsignacion($asignacion_id)
    {
        $query = "SELECT c.oac_id, c.oac_asignacion, c.oac_marcado, c.oac_borrado, c.oac_creacion,
                         c.oac_texto as oac_mensaje, c.oac_autor as oac_emisor, 
                         u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " c
                  LEFT JOIN trd_acceso_usuarios u ON c.oac_autor = u.usr_id
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
                  oac_autor = :autor_id,
                  oac_texto = :texto,
                  oac_marcado = :marcado,
                  oac_creacion = NOW()";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":asignacion_id", $data['oac_asignacion']);
            $stmt->bindValue(":autor_id", $data['oac_emisor']); // data['oac_emisor'] comes from controller
            $stmt->bindValue(":texto", $data['oac_mensaje']); // data['oac_mensaje'] comes from controller
            $stmt->bindValue(":marcado", $data['oac_marcado'] ?? 0);

            if ($stmt->execute()) {
                $lastId = $this->conn->lastInsertId();

                // Registrar en bitácora si es una acción marcada
                $accion = "Comentario en asignación OIRS";
                if (isset($data['oac_marcado'])) {
                    if ($data['oac_marcado'] == 1) {
                        $accion = "Aprueba respuesta en asignación OIRS";
                        // FINALIZAR ASIGNACIÓN
                        $asgModel = new \App\Models\oirs_asignaciones($this->conn);
                        $asgModel->finalizar($data['oac_asignacion']);
                    }
                    if ($data['oac_marcado'] == 2)
                        $accion = "Solicita corrección en asignación OIRS";
                }

                // Intentar obtener el trámite para el log
                $this->registrarBitacora($data['oac_asignacion'], $accion, $data['oac_emisor']);

                return $lastId;
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
