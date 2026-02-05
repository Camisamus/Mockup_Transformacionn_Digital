<?php
namespace App\Models;

use PDO;

class ContribuyenteGeneral
{
    private $conn;
    private $table_name = "trd_general_contribuyentes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT tgc_id, tgc_rut, UPPER(tgc_nombre) as tgc_nombre, UPPER(tgc_apellido_paterno) as tgc_apellido_paterno, UPPER(tgc_apellido_materno) as tgc_apellido_materno, tgc_borrado FROM " . $this->table_name . " ORDER BY tgc_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tgc_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tgc_rut=:tgc_rut,
            tgc_nombre=:tgc_nombre,
            tgc_apellido_paterno=:tgc_apellido_paterno,
            tgc_apellido_materno=:tgc_apellido_materno";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tgc_rut", $data['tgc_rut']);
        $stmt->bindParam(":tgc_nombre", $data['tgc_nombre']);
        $stmt->bindParam(":tgc_apellido_paterno", $data['tgc_apellido_paterno']);
        $stmt->bindParam(":tgc_apellido_materno", $data['tgc_apellido_materno']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            tgc_rut=:tgc_rut,
            tgc_nombre=:tgc_nombre,
            tgc_apellido_paterno=:tgc_apellido_paterno,
            tgc_apellido_materno=:tgc_apellido_materno
            WHERE tgc_id=:tgc_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tgc_id", $id);
        $stmt->bindParam(":tgc_rut", $data['tgc_rut']);
        $stmt->bindParam(":tgc_nombre", $data['tgc_nombre']);
        $stmt->bindParam(":tgc_apellido_paterno", $data['tgc_apellido_paterno']);
        $stmt->bindParam(":tgc_apellido_materno", $data['tgc_apellido_materno']);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    public function delete($id)
    {
        // Physical delete as there is no 'borrado' column
        $query = "DELETE FROM " . $this->table_name . " WHERE tgc_id = :tgc_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tgc_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
