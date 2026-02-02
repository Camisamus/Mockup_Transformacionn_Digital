<?php
namespace App\Models;

use PDO;

class UsuarioPerfilAcceso
{
    private $conn;
    private $table_name = "trd_acceso_usuarios_perfiles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT up.*, u.usr_nombre as usuario_nombre, u.usr_apellido as usuario_apellido, 
                         p.prf_nombre as perfil_nombre, 
                         s.usr_nombre as subrogante_nombre, s.usr_apellido as subrogante_apellido
                  FROM " . $this->table_name . " up
                  JOIN trd_acceso_usuarios u ON up.usp_usuario_id = u.usr_id
                  JOIN trd_acceso_perfiles p ON up.usp_perfil_id = p.prf_id
                  LEFT JOIN trd_acceso_usuarios s ON up.usp_usuario_subrogante_id = s.usr_id
                  WHERE up.usp_borrado = 0
                  ORDER BY u.usr_apellido ASC, p.prf_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            usp_usuario_id=:usp_usuario_id,
            usp_perfil_id=:usp_perfil_id,
            usp_fecha_inicio=:usp_fecha_inicio,
            usp_fecha_termino=:usp_fecha_termino,
            usp_usuario_subrogante_id=:usp_usuario_subrogante_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usp_usuario_id", $data['usp_usuario_id']);
        $stmt->bindParam(":usp_perfil_id", $data['usp_perfil_id']);
        $stmt->bindParam(":usp_fecha_inicio", $data['usp_fecha_inicio']);
        $stmt->bindParam(":usp_fecha_termino", $data['usp_fecha_termino']);
        $stmt->bindParam(":usp_usuario_subrogante_id", $data['usp_usuario_subrogante_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($usuario_id, $perfil_id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            usp_fecha_inicio=:usp_fecha_inicio,
            usp_fecha_termino=:usp_fecha_termino,
            usp_usuario_subrogante_id=:usp_usuario_subrogante_id
            WHERE usp_usuario_id=:usp_usuario_id AND usp_perfil_id=:usp_perfil_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usp_usuario_id", $usuario_id);
        $stmt->bindParam(":usp_perfil_id", $perfil_id);
        $stmt->bindParam(":usp_fecha_inicio", $data['usp_fecha_inicio']);
        $stmt->bindParam(":usp_fecha_termino", $data['usp_fecha_termino']);
        $stmt->bindParam(":usp_usuario_subrogante_id", $data['usp_usuario_subrogante_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($usuario_id, $perfil_id)
    {
        $query = "UPDATE " . $this->table_name . " SET usp_borrado = 1 
                  WHERE usp_usuario_id = :usp_usuario_id AND usp_perfil_id = :usp_perfil_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usp_usuario_id", $usuario_id);
        $stmt->bindParam(":usp_perfil_id", $perfil_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
