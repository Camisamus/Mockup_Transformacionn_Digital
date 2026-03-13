<?php
namespace App\Models;

use PDO;

class general_areas
{
    private $conn;
    private $table_name = "trd_general_areas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tga_borrado = 0 ORDER BY tga_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tga_id = ? AND tga_borrado = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tga_codigo_area=:tga_codigo_area,
            tga_nombre=:tga_nombre";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tga_codigo_area", $data['tga_codigo_area']);
        $stmt->bindParam(":tga_nombre", $data['tga_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            tga_codigo_area=:tga_codigo_area,
            tga_nombre=:tga_nombre
            WHERE tga_id=:tga_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tga_id", $id);
        $stmt->bindParam(":tga_codigo_area", $data['tga_codigo_area']);
        $stmt->bindParam(":tga_nombre", $data['tga_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET tga_borrado = 1 WHERE tga_id = :tga_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tga_id", $id);
        return $stmt->execute();
    }
}
