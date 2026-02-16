<?php
namespace App\Controllers;

use App\Models\OIRS_Condicion;

class OIRS_CondicionController
{
    private $db;
    private $condicion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->condicion = new OIRS_Condicion($this->db);
    }

    public function getAll()
    {
        $result = $this->condicion->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['con_nombre'])) {
            return ["status" => "error", "message" => "El nombre de la condición es obligatorio"];
        }

        if ($this->condicion->create($data)) {
            return ["status" => "success", "message" => "Condición creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la condición"];
    }

    public function update($id, $data)
    {
        if ($this->condicion->update($id, $data)) {
            return ["status" => "success", "message" => "Condición actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la condición"];
    }

    public function delete($id)
    {
        if ($this->condicion->delete($id)) {
            return ["status" => "success", "message" => "Condición eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la condición"];
    }
}
