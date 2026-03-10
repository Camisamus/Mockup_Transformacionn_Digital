<?php
namespace App\Controllers;

use App\Models\Funcionario;

class FuncionarioController
{
    private $db;
    private $funcionario;

    public function __construct($db)
    {
        $this->db = $db;
        $this->funcionario = new Funcionario($this->db);
    }

    public function getAll()
    {
        $result = $this->funcionario->getAll();
        return ["status" => "success", "data" => $result];
    }
    public function getAllOIRS($filters = [])
    {
        $currentArea = $this->esOIRS();

        if (!$currentArea) {
            return ["status" => "success", "data" => []];
        }

        $filters = [];
        if ($currentArea['Area'] == "OIRS") {
            // Cuando pertenece a OIRS trae a todos los jefes (ofa_p = 1)
            $filters['ofa_p'] = 1;
        } else {
            // Cuando no pertenece a OIRS, si es jefe trae a los de su área que no son jefes
            if ($currentArea['jefe'] == 1) {
                $filters['ofa_p'] = 0;
                $filters['ofa_area'] = $currentArea['Area'];
            } else {
                // Si no es jefe y no es de OIRS, no trae nada
                return ["status" => "success", "data" => []];
            }
        }
        $result = $this->funcionario->getAllOIRS($filters);
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if ($this->funcionario->create($data)) {
            return ["status" => "success", "message" => "Funcionario creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el funcionario"];
    }
    function esOIRS()
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $currentuser = $_SESSION['user_id'];
        $query = "SELECT tga.tga_codigo_area, ofa.ofa_p 
                  FROM trd_general_areas tga
                  JOIN trd_oirs_funcionarios_areas ofa ON ofa.ofa_area = tga.tga_id
                  WHERE ofa.ofa_funcionario = :usr_id 
                  AND (ofa.ofa_borrado = 0 OR ofa.ofa_borrado IS NULL)";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":usr_id", $currentuser);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return [
                "Area" => $result["tga_codigo_area"],
                "jefe" => $result["ofa_p"]
            ];
        }

        return null;
    }
}
