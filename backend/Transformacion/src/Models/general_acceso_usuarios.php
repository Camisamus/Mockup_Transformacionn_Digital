<?php
namespace App\Models;

use PDO;

class general_acceso_usuarios
{
    private $conn;
    private $table_name = "trd_acceso_usuarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT usr_id, UPPER(usr_nombre) as usr_nombre, UPPER(usr_apellido) as usr_apellido, usr_rut, usr_email, usr_borrado FROM " . $this->table_name . " WHERE usr_borrado = 0 ORDER BY usr_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

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
                $usr_id = $this->conn->lastInsertId();

                // Asignar rol básico (ID 1) por defecto para funcionarios
                $queryRol = "INSERT INTO trd_acceso_rol_usuario (usp_usuario_id, usp_rol_id, usp_creacion) 
                             VALUES (:usr_id, 1, NOW())";
                $stmtRol = $this->conn->prepare($queryRol);
                $stmtRol->bindParam(":usr_id", $usr_id);

                if ($stmtRol->execute()) {
                    $this->conn->commit();
                    return true;
                }
            }

            $this->conn->rollBack();
            return false;
        } catch (\Exception $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            return false;
        }
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
