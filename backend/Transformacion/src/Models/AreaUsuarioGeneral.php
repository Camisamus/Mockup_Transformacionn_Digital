<?php
namespace App\Models;

use PDO;

class AreaUsuarioGeneral
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
                  JOIN trd_acceso_usuarios u ON au.tgau_usuario = u.usr_id
                  JOIN trd_general_areas a ON au.tgau_area = a.tga_id
                  ORDER BY u.usr_apellido ASC, a.tga_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tgau_usuario=:tgau_usuario,
            tgau_area=:tgau_area,
            tgau_estado=:tgau_estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tgau_usuario", $data['tgau_usuario']);
        $stmt->bindParam(":tgau_area", $data['tgau_area']);
        $stmt->bindParam(":tgau_estado", $data['tgau_estado']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            tgau_usuario=:tgau_usuario,
            tgau_area=:tgau_area,
            tgau_estado=:tgau_estado
            WHERE tgau_id=:tgau_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tgau_id", $id);
        $stmt->bindParam(":tgau_usuario", $data['tgau_usuario']);
        $stmt->bindParam(":tgau_area", $data['tgau_area']);
        $stmt->bindParam(":tgau_estado", $data['tgau_estado']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE tgau_id = :tgau_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tgau_id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
