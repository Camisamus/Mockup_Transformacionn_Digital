<?php
namespace App\Controllers;

use App\Models\oirs_gestiones;

class oirs_gestioncontroller
{
    private $db;
    private $gestion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->gestion = new oirs_gestiones($this->db);
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
            /* 
            // Temporalmente desactivado para pruebas de flujo según requerimiento del usuario
            switch ($data['oig_estado'] ?? '') {
                case '1':
                    $this->mailController->notificarTomaConocimiento($solicitud_id, 'Actualizacion');
                    break;
...
            }
            */
            return ["status" => "success", "message" => "Respuesta guardada con éxito"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar la gestión de OIRS"];
    }
}
