<?php
namespace App\Controllers;

use App\Models\LicenciaTramite;

class LicenciaTramiteController
{
    private $db;
    private $tramite;

    public function __construct($db)
    {
        $this->db = $db;
        $this->tramite = new LicenciaTramite($this->db);
    }

    public function getAll()
    {
        $result = $this->tramite->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['tra_nombre'])) {
            return ["status" => "error", "message" => "El nombre del trámite es obligatorio"];
        }

        $newId = $this->tramite->create($data);
        if ($newId) {
            return ["status" => "success", "message" => "Trámite creado exitosamente", "tra_id" => $newId];
        }
        return ["status" => "error", "message" => "No se pudo crear el trámite"];
    }

    public function delete($id)
    {
        if ($this->tramite->delete($id)) {
            return ["status" => "success", "message" => "Trámite eliminado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el trámite"];
    }
}
