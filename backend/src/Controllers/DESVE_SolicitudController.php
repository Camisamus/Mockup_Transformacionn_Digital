<?php

namespace App\Controllers;

use App\Models\DESVE_Solicitud;

class DESVE_SolicitudController
{
    private $db;
    private $solicitud;

    public function __construct($db)
    {
        $this->db = $db;
        $this->solicitud = new DESVE_Solicitud($this->db);
    }

    public function getAll()
    {
        $result = $this->solicitud->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function getById($id)
    {
        $result = $this->solicitud->getById($id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Solicitud not found"];
    }

    public function create($data)
    {
        if ($this->solicitud->create($data)[0]) {
            return ["status" => "success", "message" => "Solicitud created successfully", "id" => $this->solicitud->create($data)[1]];
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
