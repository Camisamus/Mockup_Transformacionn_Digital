<?php

namespace App\Models;

use PDO;
use Exception;

class SystemLog
{
    private $conn;
    private $table_name = "trd_general_logs";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los logs con filtros opcionales
     */
    public function obtenerTodos($filtros = [])
    {
        $query = "SELECT l.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " l
                  LEFT JOIN trd_acceso_usuarios u ON l.log_usuario_id = u.usr_id
                  WHERE 1=1";

        $params = [];

        if (!empty($filtros['tipo'])) {
            $query .= " AND l.log_tipo = :tipo";
            $params[':tipo'] = $filtros['tipo'];
        }

        if (!empty($filtros['modulo'])) {
            $query .= " AND l.log_modulo LIKE :modulo";
            $params[':modulo'] = "%" . $filtros['modulo'] . "%";
        }

        if (!empty($filtros['usuario'])) {
            $query .= " AND (u.usr_nombre LIKE :usuario OR u.usr_apellido LIKE :usuario OR u.usr_email LIKE :usuario)";
            $params[':usuario'] = "%" . $filtros['usuario'] . "%";
        }

        if (!empty($filtros['fecha_desde'])) {
            $query .= " AND l.log_fecha >= :fecha_desde";
            $params[':fecha_desde'] = $filtros['fecha_desde'];
        }

        if (!empty($filtros['fecha_hasta'])) {
            $query .= " AND l.log_fecha <= :fecha_hasta";
            $params[':fecha_hasta'] = $filtros['fecha_hasta'];
        }

        $query .= " ORDER BY l.log_fecha DESC LIMIT 500"; // Limit to prevent overload

        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un log específico por ID
     */
    public function obtenerPorId($id)
    {
        $query = "SELECT l.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " l
                  LEFT JOIN trd_acceso_usuarios u ON l.log_usuario_id = u.usr_id
                  WHERE l.log_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crea un nuevo registro de log
     */
    public function crear($datos)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (log_evento_codigo, log_tipo, log_severidad, log_modulo, log_usuario_id, log_accion, log_descripcion, log_detalles, log_ip, log_resultado, log_fecha)
                  VALUES 
                  (:evento, :tipo, :severidad, :modulo, :usuario_id, :accion, :descripcion, :detalles, :ip, :resultado, NOW())";

        $stmt = $this->conn->prepare($query);

        // Sanitize and bind
        $stmt->bindParam(':evento', $datos['evento']);
        $stmt->bindParam(':tipo', $datos['tipo']);
        $stmt->bindParam(':severidad', $datos['severidad']);
        $stmt->bindParam(':modulo', $datos['modulo']);
        $stmt->bindParam(':usuario_id', $datos['usuario_id']);
        $stmt->bindParam(':accion', $datos['accion']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':detalles', $datos['detalles']);
        $stmt->bindParam(':ip', $datos['ip']);
        $stmt->bindParam(':resultado', $datos['resultado']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
}
