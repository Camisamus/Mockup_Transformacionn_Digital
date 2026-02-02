<?php
namespace App\Controllers;

use App\Models\AreaGeneral;

class AreaControllerGeneral
{
    private $db;
    private $area;

    public function __construct($db)
    {
        $this->db = $db;
        $this->area = new AreaGeneral($this->db);
    }

    public function getAll()
    {
        $result = $this->area->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tga_codigo_area']) || empty($data['tga_nombre'])) {
            return ["status" => "error", "message" => "Código de área y Nombre son obligatorios"];
        }

        if ($this->area->create($data)) {
            return ["status" => "success", "message" => "Área creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el área"];
    }

    public function update($id, $data)
    {
        if ($this->area->update($id, $data)) {
            return ["status" => "success", "message" => "Área actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el área"];
    }

    public function delete($id)
    {
        if ($this->area->delete($id)) {
            return ["status" => "success", "message" => "Área eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el área"];
    }
}
