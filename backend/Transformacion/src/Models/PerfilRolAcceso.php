<?php
namespace App\Models;

use PDO;

class PerfilRolAcceso
{
    private $conn;
    private $table_name = "trd_acceso_perfiles_roles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT pr.*, p.prf_nombre, r.rol_nombre 
                  FROM " . $this->table_name . " pr
                  JOIN trd_acceso_perfiles p ON pr.pfr_perfil_id = p.prf_id
                  JOIN trd_acceso_roles r ON pr.pfr_rol_id = r.rol_id
                  WHERE pr.pfr_borrado = 0
                  ORDER BY r.rol_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            pfr_perfil_id=:pfr_perfil_id,
            pfr_rol_id=:pfr_rol_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":pfr_perfil_id", $data['pfr_perfil_id']);
        $stmt->bindParam(":pfr_rol_id", $data['pfr_rol_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($perfil_id, $rol_id)
    {
        $query = "UPDATE " . $this->table_name . " SET pfr_borrado = 1 
                  WHERE pfr_perfil_id = :pfr_perfil_id AND pfr_rol_id = :pfr_rol_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pfr_perfil_id", $perfil_id);
        $stmt->bindParam(":pfr_rol_id", $rol_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
