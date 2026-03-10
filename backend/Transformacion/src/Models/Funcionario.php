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

    public function getAllOIRS($filters = [])
    {
        $params = [];
        $query = "SELECT DISTINCT
                    usr.usr_id as fnc_id, 
                    usr.usr_email as fnc_email, 
                    UPPER(usr.usr_nombre) as fnc_nombre, 
                    UPPER(usr.usr_apellido) as fnc_apellido,
                    NULL as fnc_cargo,
                    ga.tga_nombre as fnc_area_nombre,
                    ga.tga_id as fnc_area_id,
                    ofa.ofa_p as fnc_jefe
                  FROM " . $this->table_name . " usr
                  JOIN trd_oirs_funcionarios_areas ofa ON usr.usr_id = ofa.ofa_funcionario
                  JOIN trd_general_areas ga ON ofa.ofa_area = ga.tga_id
                  WHERE usr.usr_borrado = 0 
                  AND (ofa.ofa_borrado = 0 OR ofa.ofa_borrado IS NULL)";

        if (isset($filters['ofa_p'])) {
            $query .= " AND ofa.ofa_p = :ofa_p";
            $params[':ofa_p'] = $filters['ofa_p'];
        }

        if (isset($filters['ofa_area'])) {
            $query .= " AND ga.tga_codigo_area = :ofa_area";
            $params[':ofa_area'] = $filters['ofa_area'];
        }

        if (!empty($filters['search'])) {
            $query .= " AND (usr.usr_nombre LIKE :search OR usr.usr_apellido LIKE :search OR usr.usr_email LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        $query .= " ORDER BY usr.usr_nombre ASC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
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
                  WHERE usr_id = ? AND usr_borrado = 0 LIMIT 0,1";
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
