<?php
namespace App\Controllers;

use App\Models\AreaUsuarioGeneral;

class AreaUsuarioControllerGeneral
{
    private $db;
    private $mapping;

    public function __construct($db)
    {
        $this->db = $db;
        $this->mapping = new AreaUsuarioGeneral($this->db);
    }

    public function getAll()
    {
        $result = $this->mapping->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tgau_usuario']) || empty($data['tgau_area'])) {
            return ["status" => "error", "message" => "Usuario y Área son obligatorios"];
        }

        if ($this->mapping->create($data)) {
            return ["status" => "success", "message" => "Usuario asignado al área exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo asignar el usuario al área"];
    }

    public function update($id, $data)
    {
        if ($this->mapping->update($id, $data)) {
            return ["status" => "success", "message" => "Asignación actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la asignación"];
    }

    public function delete($id)
    {
        if ($this->mapping->delete($id)) {
            return ["status" => "success", "message" => "Asignación eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la asignación"];
    }
}
