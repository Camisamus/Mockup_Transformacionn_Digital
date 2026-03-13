<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_rubro
{
    private $db;
    private $table = 'trd_desecon_rubro';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE rub_borrado = 0 ORDER BY rub_nombre ASC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_RUBRO::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE rub_id = :id AND rub_borrado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_RUBRO::getById: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (rub_id, rub_nombre, rub_creacion) 
                      VALUES (:id, :nombre, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $data['rub_id']);
            $stmt->bindParam(':nombre', $data['rub_nombre']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_RUBRO::create: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $query = "UPDATE {$this->table} SET rub_nombre = :nombre WHERE rub_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $data['rub_nombre']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_RUBRO::update: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "UPDATE {$this->table} SET rub_borrado = 1 WHERE rub_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_RUBRO::delete: " . $e->getMessage());
            return false;
        }
    }
}
