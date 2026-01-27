<?php
namespace App\Controllers;

use App\Models\ContribuyenteGeneral;

class ContribuyenteControllerGeneral
{
    private $db;
    private $contribuyente;

    public function __construct($db)
    {
        $this->db = $db;
        $this->contribuyente = new ContribuyenteGeneral($this->db);
    }

    public function getAll()
    {
        $result = $this->contribuyente->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        // Basic validation
        if (empty($data['tgc_rut']) || empty($data['tgc_nombre']) || empty($data['tgc_apellido_materno'])) {
            return ["status" => "error", "message" => "RUT, Nombre y Apellido Materno son obligatorios"];
        }

        if ($this->contribuyente->create($data)) {
            return ["status" => "success", "message" => "Contribuyente creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el contribuyente"];
    }

    public function update($id, $data)
    {
        if ($this->contribuyente->update($id, $data)) {
            return ["status" => "success", "message" => "Contribuyente actualizado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el contribuyente"];
    }

    public function delete($id)
    {
        if ($this->contribuyente->delete($id)) {
            return ["status" => "success", "message" => "Contribuyente eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el contribuyente"];
    }
}
