<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_fiscalizacion
{
    private $db;
    private $table = 'trd_desecon_fiscalizacion';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE def_borrado = 0 ORDER BY def_creacion DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_FISCALIZACION::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (def_postulacion, def_funcionario_id, def_creacion) 
                      VALUES (:postulacion, :funcionario, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':postulacion', $data['def_postulacion']);
            $stmt->bindParam(':funcionario', $data['def_funcionario_id']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_FISCALIZACION::create: " . $e->getMessage());
            return false;
        }
    }
}
