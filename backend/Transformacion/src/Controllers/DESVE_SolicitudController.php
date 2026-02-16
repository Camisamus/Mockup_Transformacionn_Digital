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
    public function getAllNL()
    {
        $result = $this->solicitud->getAllNL();

        return ["status" => "success", "data" => $result];
    }
    public function getAllCompletedNL()
    {
        $result = $this->solicitud->getAllCompletedNL();

        return ["status" => "success", "data" => $result];
    }

    public function getAllCompletedNLWithDateFilter($fechaInicio = null, $fechaFin = null)
    {
        $result = $this->solicitud->getAllCompletedNLWithDateFilter($fechaInicio, $fechaFin);

        return ["status" => "success", "data" => $result];
    }

    public function getAllForReingreso()
    {
        $result = $this->solicitud->getAllForReingreso();
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
        $result = $this->solicitud->create($data);
        if ($result[0]) {
            return [
                "status" => "success",
                "message" => "Solicitud created successfully",
                "id" => $result[1],
                "rgt_id" => $result[2]
            ];
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
        return [
            "status" => "error",
            "message" => "Unable to update solicitud",
            "error" => $this->solicitud->lastError,
            "data" => $data
        ];
    }

    public function delete($id)
    {
        if ($this->solicitud->delete($id)) {
            return ["status" => "success", "message" => "Solicitud deleted successfully"];
        }
        return [
            "status" => "error",
            "message" => "Unable to delete solicitud",
            "error" => $this->solicitud->lastError
        ];
    }
}
