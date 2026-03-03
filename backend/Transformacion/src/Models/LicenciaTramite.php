<?php
namespace App\Models;

use PDO;

class LicenciaTramite
{
    private $conn;
    private $table_name = "trd_licencias_tramite";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT tra_id, tra_nombre FROM " . $this->table_name . " WHERE tra_borrado = 0 ORDER BY tra_nombre ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Si tra_borrado no existe aún en la tabla, traer todo
            $query = "SELECT tra_id, tra_nombre FROM " . $this->table_name . " ORDER BY tra_nombre ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tra_id = ? AND tra_borrado = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET tra_nombre=:tra_nombre, tra_borrado=0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tra_nombre", $data['tra_nombre']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET tra_borrado = 1 WHERE tra_id = :tra_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tra_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
