<?php
namespace App\Controllers;

use App\Models\OIRS_Gestion;

class OIRS_GestionController
{
    private $db;
    private $gestion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->gestion = new OIRS_Gestion($this->db);
    }

    public function create($data)
    {
        if (empty($data['oig_solicitud'])) {
            return ["status" => "error", "message" => "ID de solicitud es requerido"];
        }

        if ($this->gestion->create($data)) {
            return ["status" => "success", "message" => "Gestión de OIRS creada correctamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la gestión de OIRS"];
    }

    public function getBySolicitud($solicitud_id)
    {
        $data = $this->gestion->getBySolicitudId($solicitud_id);
        return ["status" => "success", "data" => $data];
    }

    public function update($solicitud_id, $data)
    {
        if (empty($solicitud_id)) {
            return ["status" => "error", "message" => "ID de solicitud es requerido"];
        }

        if ($this->gestion->update($solicitud_id, $data)) {
            return ["status" => "success", "message" => "Gestión de OIRS actualizada correctamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la gestión de OIRS"];
    }
}
