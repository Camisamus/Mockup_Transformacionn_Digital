<?php

namespace App\Controllers;

use App\Models\desecon_rubro;
use App\Models\desecon_docrequerida;

class desecon_rubrocontroller
{
    private $db;
    private $rubro;
    private $docRequerida;

    public function __construct($db)
    {
        $this->db = $db;
        $this->rubro = new desecon_rubro($this->db);
        $this->docRequerida = new desecon_docrequerida($this->db);
    }

    /**
     * Obtiene todos los rubros activos.
     */
    public function getAll()
    {
        $result = $this->rubro->getAll();
        return ["status" => "success", "data" => $result];
    }

    /**
     * Obtiene un rubro por su ID.
     */
    public function getById($id)
    {
        $result = $this->rubro->getById($id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Rubro no encontrado"];
    }

    /**
     * Obtiene los documentos requeridos para un rubro específico.
     */
    public function getRequiredDocs($rubro_id)
    {
        $result = $this->docRequerida->getByRubro($rubro_id);
        return ["status" => "success", "data" => $result];
    }
}
