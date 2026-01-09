<?php
namespace App\Controllers;

use App\Models\Respuesta;

class RespuestaController
{
    private $db;
    private $respuesta;

    public function __construct($db)
    {
        $this->db = $db;
        $this->respuesta = new Respuesta($this->db);
    }

    public function create($data)
    {
        if (empty($data['res_solicitud_id']) || empty($data['res_texto'])) {
            return ["status" => "error", "message" => "Datos incompletos (res_solicitud_id y res_texto requeridos)"];
        }

        if ($this->respuesta->create($data)) {
            return ["status" => "success", "message" => "Respuesta ingresada correctamente"];
        }
        return ["status" => "error", "message" => "No se pudo ingresar la respuesta"];
    }
}
