<?php
namespace App\Controllers;

use App\Models\OIRS_TipoAtencion;

class OIRS_TipoAtencionController
{
    private $db;
    private $tipoAtencion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->tipoAtencion = new OIRS_TipoAtencion($this->db);
    }

    public function getAll()
    {
        $result = $this->tipoAtencion->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tat_nombre'])) {
            return ["status" => "error", "message" => "El nombre del tipo de atención es obligatorio"];
        }

        if ($this->tipoAtencion->create($data)) {
            return ["status" => "success", "message" => "Tipo de atención creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el tipo de atención"];
    }

    public function update($id, $data)
    {
        if ($this->tipoAtencion->update($id, $data)) {
            return ["status" => "success", "message" => "Tipo de atención actualizado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el tipo de atención"];
    }

    public function delete($id)
    {
        if ($this->tipoAtencion->delete($id)) {
            return ["status" => "success", "message" => "Tipo de atención eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el tipo de atención"];
    }
}
