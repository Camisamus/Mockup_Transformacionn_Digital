<?php
namespace App\Controllers;

use App\Models\general_tipos_organizacion;

class general_tipoorganizacioncontroller
{
    private $db;
    private $tipoOrganizacion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->tipoOrganizacion = new general_tipos_organizacion($this->db);
    }

    public function getAll()
    {
        $result = $this->tipoOrganizacion->getAll();
        return ["status" => "success", "data" => $result];
    }
}
