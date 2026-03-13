<?php

namespace App\Models;

use PDO;
use Exception;

class general_registro_general_expedientes
{
    private $db;
    private $table = 'trd_general_registro_general_expedientes';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} 
                      (rgt_id_publica, rgt_tramite, rgt_creador, rgt_contribuyente, rgt_creacion, rgt_actualizacion) 
                      VALUES (:id_publica, :tramite, :creador, :contribuyente, NOW(), NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_publica', $data['rgt_id_publica'] ?? null);
            $stmt->bindValue(':tramite', $data['rgt_tramite'] ?? null);
            $stmt->bindValue(':creador', $data['rgt_creador'] ?? null, $data['rgt_creador'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $stmt->bindValue(':contribuyente', $data['rgt_contribuyente'] ?? null, $data['rgt_contribuyente'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            }
            return false;
        } catch (\PDOException $e) {
            error_log("Error en general_registro_general_expedientes::create: " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            error_log("Error general en general_registro_general_expedientes::create: " . $e->getMessage());
            return false;
        }
    }
}
