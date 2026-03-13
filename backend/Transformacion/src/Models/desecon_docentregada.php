<?php

namespace App\Models;

use PDO;
use Exception;

class desecon_docentregada
{
    private $db;
    private $table = 'trd_desecon_docentregada';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO {$this->table} 
                      (dee_documentacion, dee_emprendedor, dee_nombre, dee_documento, dee_estado) 
                      VALUES (:doc_req_id, :rut, :nombre, :archivo, 'Pendiente')";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':doc_req_id', $data['dee_documentacion']);
            $stmt->bindParam(':rut', $data['dee_emprendedor']);
            $stmt->bindParam(':nombre', $data['dee_nombre']);
            $stmt->bindParam(':archivo', $data['dee_documento']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en desecon_docentregada::create: " . $e->getMessage());
            return false;
        }
    }

    public function getByRut($rut)
    {
        $query = "SELECT * FROM {$this->table} WHERE dee_emprendedor = :rut";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
