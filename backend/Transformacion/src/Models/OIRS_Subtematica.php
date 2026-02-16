<?php
namespace App\Models;

use PDO;

class OIRS_Subtematica
{
    private $conn;
    private $table_name = "trd_oirs_subtematicas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT s.sub_id, s.tem_id, s.sub_nombre, t.tem_nombre as tematica_nombre 
                  FROM " . $this->table_name . " s
                  JOIN trd_oirs_tematicas t ON s.tem_id = t.tem_id
                  ORDER BY s.sub_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sub_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
            tem_id=:tem_id,
            sub_nombre=:sub_nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tem_id", $data['tem_id']);
        $stmt->bindParam(":sub_nombre", $data['sub_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET 
            tem_id=:tem_id,
            sub_nombre=:sub_nombre 
            WHERE sub_id=:sub_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sub_id", $id);
        $stmt->bindParam(":tem_id", $data['tem_id']);
        $stmt->bindParam(":sub_nombre", $data['sub_nombre']);

        if ($stmt->execute()) {
            return $stmt->rowCount() >= 0;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE sub_id = :sub_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sub_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
