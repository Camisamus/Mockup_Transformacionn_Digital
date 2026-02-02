<?php
namespace App\Controllers;

use App\Models\UsuarioPerfilAcceso;

class UsuarioPerfilControllerAcceso
{
    private $db;
    private $mapping;

    public function __construct($db)
    {
        $this->db = $db;
        $this->mapping = new UsuarioPerfilAcceso($this->db);
    }

    public function getAll()
    {
        $result = $this->mapping->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['usp_usuario_id']) || empty($data['usp_perfil_id'])) {
            return ["status" => "error", "message" => "Usuario y Perfil son obligatorios"];
        }

        try {
            if ($this->mapping->create($data)) {
                return ["status" => "success", "message" => "Perfil asignado exitosamente"];
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                return ["status" => "error", "message" => "Este usuario ya tiene este perfil asignado."];
            }
        }
        return ["status" => "error", "message" => "No se pudo asignar el perfil"];
    }

    public function update($usuario_id, $perfil_id, $data)
    {
        if ($this->mapping->update($usuario_id, $perfil_id, $data)) {
            return ["status" => "success", "message" => "Asignación actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la asignación"];
    }

    public function delete($usuario_id, $perfil_id)
    {
        if ($this->mapping->delete($usuario_id, $perfil_id)) {
            return ["status" => "success", "message" => "Asignación eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la asignación"];
    }
}
