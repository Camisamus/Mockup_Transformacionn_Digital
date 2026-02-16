<?php
namespace App\Controllers;

use App\Models\OIRS_Tematica;

class OIRS_TematicaController
{
    private $db;
    private $tematica;

    public function __construct($db)
    {
        $this->db = $db;
        $this->tematica = new OIRS_Tematica($this->db);
    }

    public function getAll()
    {
        $result = $this->tematica->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tem_nombre'])) {
            return ["status" => "error", "message" => "El nombre de la temática es obligatorio"];
        }

        if ($this->tematica->create($data)) {
            return ["status" => "success", "message" => "Temática creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la temática"];
    }

    public function update($id, $data)
    {
        if ($this->tematica->update($id, $data)) {
            return ["status" => "success", "message" => "Temática actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la temática"];
    }

    public function delete($id)
    {
        if ($this->tematica->delete($id)) {
            return ["status" => "success", "message" => "Temática eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la temática"];
    }
}
