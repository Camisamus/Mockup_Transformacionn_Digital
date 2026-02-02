<?php
namespace App\Controllers;

use App\Models\UsuarioAcceso;

class UsuarioControllerAcceso
{
    private $db;
    private $usuario;

    public function __construct($db)
    {
        $this->db = $db;
        $this->usuario = new UsuarioAcceso($this->db);
    }

    public function getAll()
    {
        $result = $this->usuario->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['usr_nombre']) || empty($data['usr_rut'])) {
            return ["status" => "error", "message" => "Nombre y RUT son obligatorios"];
        }

        if ($this->usuario->create($data)) {
            return ["status" => "success", "message" => "Usuario creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el usuario"];
    }

    public function update($id, $data)
    {
        if ($this->usuario->update($id, $data)) {
            return ["status" => "success", "message" => "Usuario actualizado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el usuario"];
    }

    public function delete($id)
    {
        if ($this->usuario->delete($id)) {
            return ["status" => "success", "message" => "Usuario eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el usuario"];
    }
}
