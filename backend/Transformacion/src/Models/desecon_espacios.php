<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_espacios
{
    private $db;
    private $table = 'trd_desecon_espacios';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE des_borrado = 0 ORDER BY des_nombre ASC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_ESPACIOS::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE des_id = :id AND des_borrado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_ESPACIOS::getById: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (des_nombre, des_direccion, des_lat, det_lon, des_tipo, des_equipamiento, des_estado_actual, des_es_reservable, des_creacion) 
                      VALUES (:nombre, :direccion, :lat, :lon, :tipo, :equipamiento, :estado, :reservable, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $data['des_nombre']);
            $stmt->bindParam(':direccion', $data['des_direccion']);
            $stmt->bindParam(':lat', $data['des_lat']);
            $stmt->bindParam(':lon', $data['det_lon']);
            $stmt->bindParam(':tipo', $data['des_tipo']);
            $stmt->bindParam(':equipamiento', $data['des_equipamiento']);
            $stmt->bindParam(':estado', $data['des_estado_actual']);
            $stmt->bindParam(':reservable', $data['des_es_reservable']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_ESPACIOS::create: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $fields = [];
            foreach ($data as $key => $value) {
                $fields[] = "$key = :$key";
            }
            $query = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE des_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_ESPACIOS::update: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "UPDATE {$this->table} SET des_borrado = 1 WHERE des_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_ESPACIOS::delete: " . $e->getMessage());
            return false;
        }
    }
}
