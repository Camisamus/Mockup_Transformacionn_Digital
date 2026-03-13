<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_docrequerida
{
    private $db;
    private $table = 'trd_desecon_docrequerida';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getByRubro($rubro_id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE (ded_rubro = :rubro OR ded_rubro = 0) AND ded_borrado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rubro', $rubro_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en desecon_docrequerida::getByRubro: " . $e->getMessage());
            return [];
        }
    }
}
