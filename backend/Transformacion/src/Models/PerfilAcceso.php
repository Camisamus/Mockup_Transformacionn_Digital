<?php
namespace App\Models;

use PDO;

class PerfilAcceso
{
    private $conn;
    private $table_name = "trd_acceso_perfiles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE prf_borrado = 0 ORDER BY prf_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            prf_nombre=:prf_nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":prf_nombre", $data['prf_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            prf_nombre=:prf_nombre
            WHERE prf_id=:prf_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":prf_id", $id);
        $stmt->bindParam(":prf_nombre", $data['prf_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET prf_borrado = 1 WHERE prf_id = :prf_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":prf_id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
