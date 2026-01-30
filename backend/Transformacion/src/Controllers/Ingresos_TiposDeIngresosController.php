<?php
namespace App\Controllers;

use App\Models\Ingresos_TiposDeIngresos;

class Ingresos_TiposDeIngresosController
{
    private $db;
    private $model;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new Ingresos_TiposDeIngresos($this->db);
    }

    public function getAll()
    {
        $result = $this->model->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function getById($id)
    {
        $result = $this->model->getById($id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Tipo de ingreso no encontrado"];
    }
}
