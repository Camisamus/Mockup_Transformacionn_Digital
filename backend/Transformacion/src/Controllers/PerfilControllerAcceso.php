<?php
namespace App\Controllers;

use App\Models\PerfilAcceso;

class PerfilControllerAcceso
{
    private $db;
    private $perfil;

    public function __construct($db)
    {
        $this->db = $db;
        $this->perfil = new PerfilAcceso($this->db);
    }

    public function getAll()
    {
        $result = $this->perfil->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['prf_nombre'])) {
            return ["status" => "error", "message" => "El nombre del perfil es obligatorio"];
        }

        if ($this->perfil->create($data)) {
            return ["status" => "success", "message" => "Perfil creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el perfil"];
    }

    public function update($id, $data)
    {
        if ($this->perfil->update($id, $data)) {
            return ["status" => "success", "message" => "Perfil actualizado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el perfil"];
    }

    public function delete($id)
    {
        if ($this->perfil->delete($id)) {
            return ["status" => "success", "message" => "Perfil eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el perfil"];
    }
}
