<?php
namespace App\Models;

use PDO;

class OrganizacionDESVE
{
    private $conn;
    private $table_name = "trd_desve_organizaciones";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE org_borrado = 0 ORDER BY org_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE org_id = ? AND org_borrado = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            org_nombre=:org_nombre,
            org_tipo_id=:org_tipo_id,
            org_direccion=:org_direccion,
            org_latitud=:org_latitud,
            org_longitud=:org_longitud";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":org_nombre", $data['org_nombre']);
        $stmt->bindParam(":org_tipo_id", $data['org_tipo_id']);
        // Optional fields
        $direccion = $data['org_direccion'] ?? null;
        $lat = $data['org_latitud'] ?? null;
        $lon = $data['org_longitud'] ?? null;

        $stmt->bindParam(":org_direccion", $direccion);
        $stmt->bindParam(":org_latitud", $lat);
        $stmt->bindParam(":org_longitud", $lon);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            org_nombre=:org_nombre,
            org_tipo_id=:org_tipo_id";

        // Add optional fields if provided
        if (isset($data['org_direccion'])) {
            $query .= ", org_direccion=:org_direccion";
        }
        if (isset($data['org_latitud'])) {
            $query .= ", org_latitud=:org_latitud";
        }
        if (isset($data['org_longitud'])) {
            $query .= ", org_longitud=:org_longitud";
        }

        $query .= " WHERE org_id=:org_id AND org_borrado = 0";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":org_id", $id);
        $stmt->bindParam(":org_nombre", $data['org_nombre']);
        $stmt->bindParam(":org_tipo_id", $data['org_tipo_id']);

        // Bind optional fields if provided
        if (isset($data['org_direccion'])) {
            $stmt->bindParam(":org_direccion", $data['org_direccion']);
        }
        if (isset($data['org_latitud'])) {
            $stmt->bindParam(":org_latitud", $data['org_latitud']);
        }
        if (isset($data['org_longitud'])) {
            $stmt->bindParam(":org_longitud", $data['org_longitud']);
        }

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    public function delete($id)
    {
        // Logical delete: set org_borrado = 1
        $query = "UPDATE " . $this->table_name . " SET org_borrado = 1 WHERE org_id = :org_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":org_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
