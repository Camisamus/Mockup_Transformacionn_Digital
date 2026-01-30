<?php
namespace App\Controllers;

use App\Models\Sector;

class SectorController
{
    private $db;
    private $sector;

    public function __construct($db)
    {
        $this->db = $db;
        $this->sector = new Sector($this->db);
    }

    public function getAll()
    {
        $result = $this->sector->getAll();
        return ["status" => "success", "data" => $result];
    }
}
