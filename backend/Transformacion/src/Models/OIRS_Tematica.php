<?php
namespace App\Models;

use PDO;

class OIRS_Tematica
{
    private $conn;
    private $table_name = "trd_oirs_tematicas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT tem_id, tem_nombre FROM " . $this->table_name . " ORDER BY tem_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tem_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET tem_nombre=:tem_nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tem_nombre", $data['tem_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET tem_nombre=:tem_nombre WHERE tem_id=:tem_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tem_id", $id);
        $stmt->bindParam(":tem_nombre", $data['tem_nombre']);

        if ($stmt->execute()) {
            return $stmt->rowCount() >= 0; // >= 0 because if no changes made but query successful, it's still OK
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE tem_id = :tem_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tem_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
