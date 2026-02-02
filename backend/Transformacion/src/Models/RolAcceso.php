<?php
namespace App\Models;

use PDO;

class RolAcceso
{
    private $conn;
    private $table_name = "trd_acceso_roles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE rol_borrado = 0 ORDER BY rol_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            rol_id=:rol_id,
            rol_nombre=:rol_nombre,
            rol_enlace=:rol_enlace,
            rol_tipo=:rol_tipo";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":rol_id", $data['rol_id']);
        $stmt->bindParam(":rol_nombre", $data['rol_nombre']);
        $stmt->bindParam(":rol_enlace", $data['rol_enlace']);
        $stmt->bindParam(":rol_tipo", $data['rol_tipo']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            rol_nombre=:rol_nombre,
            rol_enlace=:rol_enlace,
            rol_tipo=:rol_tipo
            WHERE rol_id=:rol_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":rol_id", $id);
        $stmt->bindParam(":rol_nombre", $data['rol_nombre']);
        $stmt->bindParam(":rol_enlace", $data['rol_enlace']);
        $stmt->bindParam(":rol_tipo", $data['rol_tipo']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET rol_borrado = 1 WHERE rol_id = :rol_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":rol_id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
