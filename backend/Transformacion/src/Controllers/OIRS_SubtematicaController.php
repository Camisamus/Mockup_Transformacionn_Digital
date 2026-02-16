<?php
namespace App\Controllers;

use App\Models\OIRS_Subtematica;

class OIRS_SubtematicaController
{
    private $db;
    private $subtematica;

    public function __construct($db)
    {
        $this->db = $db;
        $this->subtematica = new OIRS_Subtematica($this->db);
    }

    public function getAll()
    {
        $result = $this->subtematica->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tem_id']) || empty($data['sub_nombre'])) {
            return ["status" => "error", "message" => "El ID de temática y el nombre de subtemática son obligatorios"];
        }

        if ($this->subtematica->create($data)) {
            return ["status" => "success", "message" => "Subtemática creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la subtemática"];
    }

    public function update($id, $data)
    {
        if ($this->subtematica->update($id, $data)) {
            return ["status" => "success", "message" => "Subtemática actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la subtemática"];
    }

    public function delete($id)
    {
        if ($this->subtematica->delete($id)) {
            return ["status" => "success", "message" => "Subtemática eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la subtemática"];
    }
}
