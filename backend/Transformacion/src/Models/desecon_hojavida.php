<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_hojavida
{
    private $db;
    private $table = 'trd_desecon_hojavida';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getByRut($rut)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE deh_rut = :rut ORDER BY deh_creacion DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rut', $rut);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_HOJAVIDA::getByRut: " . $e->getMessage());
            return [];
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (deh_rut, deh_accion, deh_descripcion, deh_creacion) 
                      VALUES (:rut, :accion, :descripcion, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rut', $data['deh_rut']);
            $stmt->bindParam(':accion', $data['deh_accion']);
            $stmt->bindParam(':descripcion', $data['deh_descripcion']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_HOJAVIDA::create: " . $e->getMessage());
            return false;
        }
    }
}
