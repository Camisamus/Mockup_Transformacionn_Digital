<?php
namespace App\Controllers;

use App\Models\general_organizaciones;

class sistema_organizacioncontroller
{
    private $db;
    private $organizacion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->organizacion = new general_organizaciones($this->db);
    }

    public function getAll()
    {
        $result = $this->organizacion->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if ($this->organizacion->create($data)) {
            return ["status" => "success", "message" => "Organización creada exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear la organización"];
    }
}
