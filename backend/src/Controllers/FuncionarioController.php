<?php
namespace App\Controllers;

use App\Models\Funcionario;

class FuncionarioController
{
    private $db;
    private $funcionario;

    public function __construct($db)
    {
        $this->db = $db;
        $this->funcionario = new Funcionario($this->db);
    }

    public function getAll()
    {
        $result = $this->funcionario->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if ($this->funcionario->create($data)) {
            return ["status" => "success", "message" => "Funcionario creado exitosamente"];
        }
        return ["status" => "error", "message" => "No se pudo crear el funcionario"];
    }
}
