<?php
namespace App\Controllers;

use App\Models\OIRS_RolOirs;

class OIRS_RolOirsController
{
    private $db;
    private $mapping;

    public function __construct($db)
    {
        $this->db = $db;
        $this->mapping = new OIRS_RolOirs($this->db);
    }

    public function getAll()
    {
        $result = $this->mapping->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (
            !isset($data['ofa_area']) || $data['ofa_area'] === '' ||
            !isset($data['ofa_funcionario']) || $data['ofa_funcionario'] === ''
        ) {
            return ["status" => "error", "message" => "Funcionario y Área son obligatorios"];
        }

        try {
            if ($this->mapping->create($data)) {
                return ["status" => "success", "message" => "Asignación creada exitosamente"];
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                return ["status" => "error", "message" => "Este vínculo ya existe o el registro está en la papelera."];
            }
            return ["status" => "error", "message" => "Ocurrió un error en la base de datos."];
        }
        return ["status" => "error", "message" => "No se pudo crear el vínculo"];
    }

    public function delete($ofa_funcionario, $ofa_area)
    {
        if ($this->mapping->delete($ofa_funcionario, $ofa_area)) {
            return ["status" => "success", "message" => "Asignación eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la asignación"];
    }
}
