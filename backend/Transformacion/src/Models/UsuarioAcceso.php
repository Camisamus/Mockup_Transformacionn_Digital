<?php
namespace App\Models;

use PDO;

class UsuarioAcceso
{
    private $conn;
    private $table_name = "trd_acceso_usuarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE usr_borrado = 0 ORDER BY usr_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            usr_nombre=:usr_nombre,
            usr_apellido=:usr_apellido,
            usr_rut=:usr_rut,
            usr_email=:usr_email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usr_nombre", $data['usr_nombre']);
        $stmt->bindParam(":usr_apellido", $data['usr_apellido']);
        $stmt->bindParam(":usr_rut", $data['usr_rut']);
        $stmt->bindParam(":usr_email", $data['usr_email']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            usr_nombre=:usr_nombre,
            usr_apellido=:usr_apellido,
            usr_rut=:usr_rut,
            usr_email=:usr_email
            WHERE usr_id=:usr_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usr_id", $id);
        $stmt->bindParam(":usr_nombre", $data['usr_nombre']);
        $stmt->bindParam(":usr_apellido", $data['usr_apellido']);
        $stmt->bindParam(":usr_rut", $data['usr_rut']);
        $stmt->bindParam(":usr_email", $data['usr_email']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET usr_borrado = 1 WHERE usr_id = :usr_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usr_id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
