<?php
namespace App\Controllers;

use App\Models\TipoOrganizacion;

class TipoOrganizacionController
{
    private $db;
    private $tipoOrganizacion;

    public function __construct($db)
    {
        $this->db = $db;
        $this->tipoOrganizacion = new TipoOrganizacion($this->db);
    }

    public function getAll()
    {
        $result = $this->tipoOrganizacion->getAll();
        return ["status" => "success", "data" => $result];
    }
}
