<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_postulaciones
{
    private $db;
    private $table = 'trd_desecon_postulaciones';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE dep_borrado = 0 ORDER BY dep_creacion DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_POSTULACIONES::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE dep_id = :id AND dep_borrado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_POSTULACIONES::getById: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (dep_emprendimiento, dep_convocatoria, dep_estado, dep_creacion) 
                      VALUES (:emprendimiento, :convocatoria, :estado, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':emprendimiento', $data['dep_emprendimiento']);
            $stmt->bindParam(':convocatoria', $data['dep_convocatoria']);
            $stmt->bindParam(':estado', $data['dep_estado']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_POSTULACIONES::create: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $query = "UPDATE {$this->table} SET dep_estado = :estado WHERE dep_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':estado', $data['dep_estado']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_POSTULACIONES::update: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "UPDATE {$this->table} SET dep_borrado = 1 WHERE dep_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_POSTULACIONES::delete: " . $e->getMessage());
            return false;
        }
    }
}
