<?php
namespace App\Controllers;

use App\Models\Prioridad;

class PrioridadController
{
    private $db;
    private $prioridad;

    public function __construct($db)
    {
        $this->db = $db;
        $this->prioridad = new Prioridad($this->db);
    }

    public function getAll()
    {
        $result = $this->prioridad->getAll();
        return ["status" => "success", "data" => $result];
    }
}
