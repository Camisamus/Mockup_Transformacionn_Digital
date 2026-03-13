<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_puntaje
{
    private $db;
    private $table = 'trd_desecon_puntaje';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getByRut($rut)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE dep_rut = :rut ORDER BY dep_creacion DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rut', $rut);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_PUNTAJE::getByRut: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalPuntaje($rut)
    {
        try {
            $query = "SELECT SUM(CASE WHEN dep_accion = 'Abono' THEN dep_valor ELSE -dep_valor END) as total 
                      FROM {$this->table} WHERE dep_rut = :rut";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rut', $rut);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            error_log("Error en DESECON_PUNTAJE::getTotalPuntaje: " . $e->getMessage());
            return 0;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (dep_rut, dep_accion, dep_motivo, dep_valor, dep_creacion) 
                      VALUES (:rut, :accion, :motivo, :valor, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':rut', $data['dep_rut']);
            $stmt->bindParam(':accion', $data['dep_accion']);
            $stmt->bindParam(':motivo', $data['dep_motivo']);
            $stmt->bindParam(':valor', $data['dep_valor']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_PUNTAJE::create: " . $e->getMessage());
            return false;
        }
    }
}
