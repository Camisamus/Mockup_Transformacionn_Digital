<?php
namespace App\Models;

use PDO;

class Tarea
{
    private $conn;
    private $table_name = "trd_tareas";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    public function listar($usr_id)
    {
        $query = "SELECT c.*
                  FROM trd_tareas c
                  WHERE c.tar_asignador = :usr_id
                  AND (
                      (c.tar_estado = 1 AND c.tar_plazo >= NOW()) 
                      OR 
                      (c.tar_estado = 0)
                  ) 
                  ORDER BY c.tar_estado ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":usr_id", $usr_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($usr_id)
    {
        $query = "SELECT c.*
                  FROM " . $this->table_name . " c
                  WHERE c.tar_asignado = :usr_id AND c.tar_estado = 0
                  ORDER BY c.tar_fecha DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":usr_id", $usr_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data, $asignador_id)
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
                  tar_asignador = :asignador_id,
                  tar_asignado = :usr_id,
                  tar_titulo = :tar_titulo,
                  tar_detalle = :tar_detalle,
                  tar_plazo = :tar_plazo,
                  tar_estado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":asignador_id", $asignador_id);
        $stmt->bindValue(":usr_id", $data['usr_id']);
        $stmt->bindValue(":tar_titulo", $data['tar_titulo']);
        $stmt->bindValue(":tar_detalle", $data['tar_detalle']);
        $stmt->bindValue(":tar_plazo", $data['tar_plazo']);

        return $stmt->execute();
    }

    public function terminar($data)
    {
        $query = "UPDATE " . $this->table_name . " SET 
                  tar_estado = 1
                  WHERE tar_id = :tar_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":tar_id", $data['tar_id']);

        return $stmt->execute();
    }
}
