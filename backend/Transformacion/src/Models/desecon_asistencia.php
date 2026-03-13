<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_asistencia
{
    private $db;
    private $table = 'trd_desecon_asistencia';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} ORDER BY dea_fecha DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_ASISTENCIA::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (dea_postulacion, dea_fecha, dea_accion, dea_evaluacion, dea_creacion) 
                      VALUES (:postulacion, :fecha, :accion, :evaluacion, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':postulacion', $data['dea_postulacion']);
            $stmt->bindParam(':fecha', $data['dea_fecha']);
            $stmt->bindParam(':accion', $data['dea_accion']);
            $stmt->bindParam(':evaluacion', $data['dea_evaluacion']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_ASISTENCIA::create: " . $e->getMessage());
            return false;
        }
    }
}
