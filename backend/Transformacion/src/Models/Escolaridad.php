<?php
namespace App\Models;

use PDO;

class Escolaridad
{
    private $conn;
    private $table_name = "trd_cont_escolaridad";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT esc_id, esc_nombre FROM " . $this->table_name . " ORDER BY esc_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE esc_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
            esc_nombre=:esc_nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":esc_nombre", $data['esc_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET 
            esc_nombre=:esc_nombre 
            WHERE esc_id=:esc_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":esc_id", $id);
        $stmt->bindParam(":esc_nombre", $data['esc_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE esc_id = :esc_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":esc_id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
