<?php
namespace App\Controllers;

use App\Models\RolAcceso;

class RolControllerAcceso
{
    private $db;
    private $rol;

    public function __construct($db)
    {
        $this->db = $db;
        $this->rol = new RolAcceso($this->db);
    }

    public function getAll()
    {
        $result = $this->rol->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['rol_id']) || empty($data['rol_nombre'])) {
            return ["status" => "error", "message" => "ID de Rol y Nombre son obligatorios"];
        }

        if ($this->rol->create($data)) {
            return ["status" => "success", "message" => "Rol creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el rol"];
    }

    public function update($id, $data)
    {
        if ($this->rol->update($id, $data)) {
            return ["status" => "success", "message" => "Rol actualizado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el rol"];
    }

    public function delete($id)
    {
        if ($this->rol->delete($id)) {
            return ["status" => "success", "message" => "Rol eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el rol"];
    }
}
