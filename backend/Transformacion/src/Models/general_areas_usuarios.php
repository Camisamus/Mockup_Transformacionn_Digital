<?php
namespace App\Models;

use PDO;

class general_areas_usuarios
{
    private $conn;
    private $table_name = "trd_general_areas_usuarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT au.*, u.usr_nombre as usuario_nombre, u.usr_apellido as usuario_apellido, 
                         a.tga_nombre as area_nombre
                  FROM " . $this->table_name . " au
                  JOIN trd_acceso_usuarios u ON au.tau_usuario_id = u.usr_id
                  JOIN trd_general_areas a ON au.tau_area_id = a.tga_id
                  WHERE au.tau_borrado = 0 AND a.tga_borrado = 0
                  ORDER BY u.usr_apellido ASC, a.tga_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tau_usuario_id=:tau_usuario_id,
            tau_area_id=:tau_area_id,
            tau_borrado=0";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tau_usuario_id", $data['tau_usuario_id']);
        $stmt->bindParam(":tau_area_id", $data['tau_area_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            tau_usuario_id=:tau_usuario_id,
            tau_area_id=:tau_area_id
            WHERE tau_id=:tau_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tau_id", $id);
        $stmt->bindParam(":tau_usuario_id", $data['tau_usuario_id']);
        $stmt->bindParam(":tau_area_id", $data['tau_area_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET tau_borrado = 1 WHERE tau_id = :tau_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tau_id", $id);
        return $stmt->execute();
    }
}
