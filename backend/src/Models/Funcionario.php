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
        // Map fields from trd_acceso_usuarios to expected trd_desve_funcionarios fields
        $query = "SELECT 
                    usr_id as fnc_id, 
                    usr_rut as fnc_rut, 
                    usr_nombre as fnc_nombre, 
                    usr_apellido as fnc_apellido,
                    NULL as fnc_cargo 
                  FROM " . $this->table_name . " 
                  ORDER BY usr_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT 
                    usr_id as fnc_id, 
                    usr_rut as fnc_rut, 
                    usr_nombre as fnc_nombre, 
                    usr_apellido as fnc_apellido,
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
