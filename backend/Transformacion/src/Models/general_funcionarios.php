<?php
namespace App\Models;

use PDO;

class general_funcionarios
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

    public function getAllCargosOIRS($filters = [])
    {
        $params = [];
        $query = "SELECT DISTINCT
                    c.car_id, 
                    c.car_nombre,
                    c.car_nivel,
                    ga.tga_nombre as area_nombre,
                    ga.tga_id as area_id
                  FROM trd_general_cargos c
                  JOIN trd_general_areas ga ON c.car_area = ga.tga_id
                  WHERE c.car_borrado = 0";

        if (isset($filters['car_nivel'])) {
            $query .= " AND c.car_nivel = :car_nivel";
            $params[':car_nivel'] = $filters['car_nivel'];
        }

        if (isset($filters['max_nivel'])) {
            $query .= " AND c.car_nivel <= :max_nivel";
            $params[':max_nivel'] = $filters['max_nivel'];
        }

        if (isset($filters['area_id'])) {
            $query .= " AND c.car_area = :area_id";
            $params[':area_id'] = $filters['area_id'];
        }

        if (!empty($filters['search'])) {
            $query .= " AND (c.car_nombre LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        $query .= " ORDER BY c.car_nombre ASC";



        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        // DEBUG: Imprimir en el log de errores de PHP
        error_log("[DEBUG_OIRS] SQL: " . $query);
        error_log("[DEBUG_OIRS] Params: " . json_encode($params));

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // DEBUG PARA COMPA: Guardar en un TXT para revisar la consulta
        $logFile = __DIR__ . "/../../debug_cargos_oirs.txt";
        $logData = "--- " . date('Y-m-d H:i:s') . " ---\n";
        $logData .= "QUERY: " . $query . "\n";
        $logData .= "PARAMS: " . json_encode($params) . "\n";
        $logData .= "RESULTADOS: " . count($results) . " encontrados\n\n";
        file_put_contents($logFile, $logData, FILE_APPEND);

        return $results;
    }

    public function getCargosByUser($userId)
    {
        $query = "SELECT fc.ofc_cargo as car_id, c.car_nombre, c.car_nivel, c.car_area
                  FROM trd_oirs_funcionarios_cargos fc
                  JOIN trd_general_cargos c ON fc.ofc_cargo = c.car_id
                  WHERE fc.ofc_funcionario = :usr_id 
                  AND fc.ofc_estado = 1 
                  AND fc.ofc_desde <= NOW() 
                  AND (fc.ofc_hasta IS NULL OR fc.ofc_hasta >= NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usr_id", $userId);
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
