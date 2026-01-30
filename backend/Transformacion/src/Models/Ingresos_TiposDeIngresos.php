<?php
namespace App\Models;

use PDO;

class Ingresos_TiposDeIngresos
{
    private $conn;
    private $table_name = "trd_ingresos_tipos_ingreso";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY titi_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE titi_id = ? AND titi_borrado = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            titi_nombre=:titi_nombre";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titi_nombre", $data['titi_nombre']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            titi_nombre=:titi_nombre WHERE titi_id=:titi_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titi_id", $id);
        $stmt->bindParam(":titi_nombre", $data['titi_nombre']);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
