<?php
namespace App\Models;

use PDO;

class general_acceso_vecino_roles
{
    private $conn;
    private $table_name = "trd_acceso_rol_usuario_vecinos";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT up.*, u.usr_nombre as usuario_nombre, u.usr_apellido as usuario_apellido, 
                         p.rol_nombre as perfil_nombre
                   FROM " . $this->table_name . " up
                   JOIN trd_acceso_vecinos u ON up.usp_usuario_id = u.usr_id
                   JOIN trd_acceso_roles_vecinos p ON up.usp_rol_id = p.rol_id
                   WHERE up.usp_borrado = 0
                   ORDER BY u.usr_apellido ASC, p.rol_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            usp_usuario_id=:usp_usuario_id,
            usp_rol_id=:usp_rol_id,
            usp_fecha_inicio=:usp_fecha_inicio,
            usp_fecha_termino=:usp_fecha_termino,
            usp_creacion=NOW()";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usp_usuario_id", $data['usp_usuario_id']);
        $stmt->bindParam(":usp_rol_id", $data['usp_rol_id']);
        $stmt->bindParam(":usp_fecha_inicio", $data['usp_fecha_inicio']);
        $stmt->bindParam(":usp_fecha_termino", $data['usp_fecha_termino']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($usuario_id, $perfil_id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            usp_fecha_inicio=:usp_fecha_inicio,
            usp_fecha_termino=:usp_fecha_termino
            WHERE usp_usuario_id=:usp_usuario_id AND usp_rol_id=:usp_rol_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usp_usuario_id", $usuario_id);
        $stmt->bindParam(":usp_rol_id", $perfil_id);
        $stmt->bindParam(":usp_fecha_inicio", $data['usp_fecha_inicio']);
        $stmt->bindParam(":usp_fecha_termino", $data['usp_fecha_termino']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($usuario_id, $perfil_id)
    {
        $query = "UPDATE " . $this->table_name . " SET usp_borrado = 1
                  WHERE usp_usuario_id = :usp_usuario_id AND usp_rol_id = :usp_rol_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usp_usuario_id", $usuario_id);
        $stmt->bindParam(":usp_rol_id", $perfil_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
