<?php
namespace App\Controllers;

use App\Models\general_funcionarios;

class sistema_funcionariocontroller
{
    private $db;
    private $funcionario;

    public function __construct($db)
    {
        $this->db = $db;
        $this->funcionario = new general_funcionarios($this->db);
    }

    public function getMiRolOIRS()
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $currentuser = $_SESSION['user_id'];
        $query = "SELECT tga.tga_codigo_area, ofa.ofa_p, ofa.ofa_area as tga_id, ofa.ofa_rol 
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
                "jefe" => $result["ofa_p"],
                "tga_id" => $result["tga_id"],
                "rol" => $result["ofa_rol"]
            ];
        }

        return null;
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
    public function getAllCargosOIRS($filters = [])
    {
        if (!isset($_SESSION['user_id'])) {
            return ["status" => "success", "data" => []];
        }

        $misCargos = $this->getMisCargosOIRS();
        $oirsInfo = $this->esOIRS();

        $maxNivelPropio = 0;
        foreach ($misCargos as $c) {
            $nivel = isset($c['car_nivel']) ? (int) $c['car_nivel'] : 1;
            if ($nivel > $maxNivelPropio)
                $maxNivelPropio = $nivel;
        }

        // El usuario proporcionó este ejemplo: 
        // [Area] => OIRS [jefe] => 0 [tga_id] => 2 [rol] => Encargado OIRS
        if ($oirsInfo && $oirsInfo['rol'] == 'Encargado OIRS') {
            $maxNivelPropio = 3;
        } elseif ($oirsInfo && $oirsInfo['jefe'] == 1 && $maxNivelPropio < 2) {
            $maxNivelPropio = 2;
        }

        if ($maxNivelPropio == 3) {
            // "El más pulento" (Admin OIRS) -> Deriva a Jefes (Nivel 2)
            $filters['car_nivel'] = 2;
        } elseif ($maxNivelPropio == 2) {
            // "Jefe" -> Deriva a Subordinados (Nivel 1) de su área
            $filters['car_nivel'] = 1;

            // Priorizamos el área del jefe si no se especificó un filtro manual
            if (!isset($filters['area_id'])) {
                if ($oirsInfo && $oirsInfo['jefe'] == 1) {
                    $filters['area_id'] = $oirsInfo['tga_id'];
                } elseif (!empty($misCargos)) {
                    $filters['area_id'] = $misCargos[0]['car_area'];
                }
            }
        } else {
            // Nivel 1 o inferior -> No tiene personal a cargo para derivar
            return ["status" => "success", "data" => []];
        }

        $result = $this->funcionario->getAllCargosOIRS($filters);
        return ["status" => "success", "data" => $result];
    }

    public function getMisCargosOIRS()
    {
        if (!isset($_SESSION['user_id']))
            return [];
        return $this->funcionario->getCargosByUser($_SESSION['user_id']);
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
        $query = "SELECT tga.tga_codigo_area, ofa.ofa_p, ofa.ofa_area as tga_id, ofa.ofa_rol 
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
                "jefe" => $result["ofa_p"],
                "tga_id" => $result["tga_id"],
                "rol" => $result["ofa_rol"]
            ];
        }

        return null;
    }
}
