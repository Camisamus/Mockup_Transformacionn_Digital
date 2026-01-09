<?php

namespace App\Controllers;

use App\Models\Solicitud;

class SolicitudController
{
    private $db;
    private $solicitud;

    public function __construct($db)
    {
        $this->db = $db;
        $this->solicitud = new Solicitud($this->db);
    }

    public function getAll()
    {
        $result = $this->solicitud->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function getById($id, $ver_clave = false)
    {
        $result = $this->solicitud->getById($id, $ver_clave);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Solicitud not found"];
    }

    public function create($data)
    {
        if ($this->solicitud->create($data)) {
            return ["status" => "success", "message" => "Solicitud created successfully"];
        }
        return [
            "status" => "error",
            "message" => "Unable to create solicitud",
            "error" => $this->solicitud->lastError
        ];
    }

    public function update($id, $data)
    {
        if ($this->solicitud->update($id, $data)) {
            return ["status" => "success", "message" => "Solicitud updated successfully"];
        }
        return ["status" => "error", "message" => "Unable to update solicitud"];
    }

    public function delete($id)
    {
        if ($this->solicitud->delete($id)) {
            return ["status" => "success", "message" => "Solicitud deleted successfully"];
        }
        return ["status" => "error", "message" => "Unable to delete solicitud"];
    }
}
