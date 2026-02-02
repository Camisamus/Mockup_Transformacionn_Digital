<?php
namespace App\Controllers;

use App\Models\PerfilRolAcceso;

class PerfilRolControllerAcceso
{
    private $db;
    private $mapping;

    public function __construct($db)
    {
        $this->db = $db;
        $this->mapping = new PerfilRolAcceso($this->db);
    }

    public function getAll()
    {
        $result = $this->mapping->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (
            !isset($data['pfr_perfil_id']) || $data['pfr_perfil_id'] === '' ||
            !isset($data['pfr_rol_id']) || $data['pfr_rol_id'] === ''
        ) {
            return ["status" => "error", "message" => "Perfil y Rol son obligatorios"];
        }

        try {
            if ($this->mapping->create($data)) {
                return ["status" => "success", "message" => "Vínculo creado exitosamente"];
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                return ["status" => "error", "message" => "Este vínculo ya existe o el registro está en la papelera."];
            }
            return ["status" => "error", "message" => "Ocurrió un error en la base de datos."];
        }
        return ["status" => "error", "message" => "No se pudo crear el vínculo"];
    }

    public function delete($perfil_id, $rol_id)
    {
        if ($this->mapping->delete($perfil_id, $rol_id)) {
            return ["status" => "success", "message" => "Vínculo eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el vínculo"];
    }
}
