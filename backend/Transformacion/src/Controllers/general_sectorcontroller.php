<?php
namespace App\Controllers;

use App\Models\general_sectores;

class general_sectorcontroller
{
    private $db;
    private $sector;

    public function __construct($db)
    {
        $this->db = $db;
        $this->sector = new general_sectores($this->db);
    }

    public function getAll()
    {
        $result = $this->sector->getAll();
        return ["status" => "success", "data" => $result];
    }
}
