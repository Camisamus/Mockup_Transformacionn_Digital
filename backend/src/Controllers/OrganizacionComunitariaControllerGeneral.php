<?php
namespace App\Controllers;

use App\Models\OrganizacionComunitariaGeneral;

class OrganizacionComunitariaControllerGeneral
{
    private $db;
    private $org;

    public function __construct($db)
    {
        $this->db = $db;
        $this->org = new OrganizacionComunitariaGeneral($this->db);
    }

    public function getAll()
    {
        $result = $this->org->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['orgc_rut']) || empty($data['orgc_nombre']) || empty($data['ogc_rep_legal']) || empty($data['orgc_tipo_organizacion'])) {
            return ["status" => "error", "message" => "Datos obligatorios faltantes (RUT, Nombre, Rep. Legal, Tipo)"];
        }

        if ($this->org->create($data)) {
            return ["status" => "success", "message" => "Organización creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la organización"];
    }

    public function update($id, $data)
    {
        if ($this->org->update($id, $data)) {
            return ["status" => "success", "message" => "Organización actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la organización"];
    }

    public function delete($id)
    {
        if ($this->org->delete($id)) {
            return ["status" => "success", "message" => "Organización eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la organización"];
    }
}
