<?php
namespace App\Controllers;

use App\Models\OrganizacionDESVE;

class OrganizacionControllerDESVE
{
    private $db;
    private $organizacion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->organizacion = new OrganizacionDESVE($this->db);
    }

    public function getAll()
    {
        $result = $this->organizacion->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if ($this->organizacion->create($data)) {
            return ["status" => "success", "message" => "Organización creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la organización"];
    }

    public function update($id, $data)
    {
        if ($this->organizacion->update($id, $data)) {
            return ["status" => "success", "message" => "Organización actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la organización"];
    }

    public function delete($id)
    {
        if ($this->organizacion->delete($id)) {
            return ["status" => "success", "message" => "Organización eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la organización"];
    }
}
