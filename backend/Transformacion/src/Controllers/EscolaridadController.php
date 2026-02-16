<?php
namespace App\Controllers;

use App\Models\Escolaridad;

class EscolaridadController
{
    private $db;
    private $escolaridad;

    public function __construct($db)
    {
        $this->db = $db;
        $this->escolaridad = new Escolaridad($this->db);
    }

    public function getAll()
    {
        $result = $this->escolaridad->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['esc_nombre'])) {
            return ["status" => "error", "message" => "El nombre de escolaridad es obligatorio"];
        }

        if ($this->escolaridad->create($data)) {
            return ["status" => "success", "message" => "Escolaridad creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la escolaridad"];
    }

    public function update($id, $data)
    {
        if (empty($data['esc_nombre'])) {
            return ["status" => "error", "message" => "El nombre de escolaridad es obligatorio"];
        }

        if ($this->escolaridad->update($id, $data)) {
            return ["status" => "success", "message" => "Escolaridad actualizada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la escolaridad"];
    }

    public function delete($id)
    {
        if ($this->escolaridad->delete($id)) {
            return ["status" => "success", "message" => "Escolaridad eliminada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar la escolaridad"];
    }
}
