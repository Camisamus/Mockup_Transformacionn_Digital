<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_convocatorias
{
    private $db;
    private $table = 'trd_desecon_convocatorias';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE dec_borrado = 0 ORDER BY dec_fecha_inicio DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_CONVOCATORIAS::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE dec_id = :id AND dec_borrado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en DESECON_CONVOCATORIAS::getById: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (dec_titulo, dec_registro_general_expediente, dec_espacio, dec_descripcion, dec_tipo, dec_fecha_inicio, dec_fecha_fin, dec_costo_puntaje, dec_capacidad, dec_img_portada, dec_bases, dec_estado, dec_creacion) 
                      VALUES (:titulo, :expediente, :espacio, :descripcion, :tipo, :inicio, :fin, :costo, :capacidad, :portada, :bases, :estado, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':titulo', $data['dec_titulo']);
            $stmt->bindParam(':expediente', $data['dec_registro_general_expediente']);
            $stmt->bindParam(':espacio', $data['dec_espacio']);
            $stmt->bindParam(':descripcion', $data['dec_descripcion']);
            $stmt->bindParam(':tipo', $data['dec_tipo']);
            $stmt->bindParam(':inicio', $data['dec_fecha_inicio']);
            $stmt->bindParam(':fin', $data['dec_fecha_fin']);
            $stmt->bindParam(':costo', $data['dec_costo_puntaje']);
            $stmt->bindParam(':capacidad', $data['dec_capacidad']);
            $stmt->bindParam(':portada', $data['dec_img_portada']);
            $stmt->bindParam(':bases', $data['dec_bases']);
            $stmt->bindParam(':estado', $data['dec_estado']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_CONVOCATORIAS::create: " . $e->getMessage());
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
            $query = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE dec_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_CONVOCATORIAS::update: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "UPDATE {$this->table} SET dec_borrado = 1 WHERE dec_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en DESECON_CONVOCATORIAS::delete: " . $e->getMessage());
            return false;
        }
    }
}
