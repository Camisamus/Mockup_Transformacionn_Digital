<?php
namespace App\Models;

use PDO;

class OIRS_Condicion
{
    private $conn;
    private $table_name = "trd_oirs_condiciones";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT con_id, con_nombre FROM " . $this->table_name . " ORDER BY con_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE con_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET con_nombre=:con_nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":con_nombre", $data['con_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET con_nombre=:con_nombre WHERE con_id=:con_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":con_id", $id);
        $stmt->bindParam(":con_nombre", $data['con_nombre']);

        if ($stmt->execute()) {
            return $stmt->rowCount() >= 0;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE con_id = :con_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":con_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
