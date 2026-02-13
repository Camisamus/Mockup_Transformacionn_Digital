<?php
namespace App\Models;

use PDO;

class Funcionario
{
    private $conn;
    private $table_name = "trd_acceso_usuarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT DISTINCT
                    usr.usr_id as fnc_id, 
                    usr.usr_email as fnc_email, 
                    UPPER(usr.usr_nombre) as fnc_nombre, 
                    UPPER(usr.usr_apellido) as fnc_apellido,
                    NULL as fnc_cargo,
                    ga.tga_nombre as fnc_area_nombre,
                    ga.tga_id as fnc_area_id
                  FROM " . $this->table_name . " usr
                  LEFT JOIN trd_general_areas_usuarios gau ON usr.usr_id = gau.tau_usuario_id
                  LEFT JOIN trd_general_areas ga ON gau.tau_area_id = ga.tga_id
                  WHERE usr.usr_borrado = 0
                  ORDER BY usr.usr_nombre ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT 
                    usr_id as fnc_id, 
                    usr_email as fnc_email, 
                    UPPER(usr_nombre) as fnc_nombre, 
                    UPPER(usr_apellido) as fnc_apellido,
                    NULL as fnc_cargo 
                  FROM " . $this->table_name . " 
                  WHERE usr_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Feature disabled
        return false;
    }
}
