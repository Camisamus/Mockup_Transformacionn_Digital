<?php
namespace App\Models;

use PDO;

class LicenciaHoras
{
    private $conn;
    private $table_disponibles = "trd_licencias_horas_disponibles";
    private $table_prioidad = "trd_licencias_prioidad";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getDisponibilidadPorFecha($fecha, $tra_id)
    {
        $query = "SELECT tlh_id, tlh_bloque_horario, tlh_prioidad, tlh_cupo 
                  FROM " . $this->table_disponibles . " 
                  WHERE tlh_fecha = :fecha AND tlh_tramite = :tra_id 
                  AND tlh_borrado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":tra_id", $tra_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el listado de vulnerabilidades (restricciones).
     */
    public function getVulnerabilidades()
    {
        $query = "SELECT * FROM " . $this->table_prioidad . " where tlv_borrado = 0 ORDER BY tlv_nombre ASC;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findRegistro($fecha, $bloque, $tra_id, $prioidad_id)
    {
        $query = "SELECT * FROM " . $this->table_disponibles . " 
                  WHERE tlh_fecha = :fecha 
                  AND tlh_bloque_horario = :bloque 
                  AND tlh_tramite = :tra_id 
                  AND tlh_prioidad = :prioidad_id 
                  AND tlh_borrado = 0 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":bloque", $bloque);
        $stmt->bindParam(":tra_id", $tra_id);
        $stmt->bindParam(":prioidad_id", $prioidad_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Guarda o actualiza disponibilidad.
     */
    public function save($data)
    {
        // Lógica de INSERT o UPDATE según corresponda
        if (isset($data['tlh_id']) && $data['tlh_id'] > 0) {
            $query = "UPDATE " . $this->table_disponibles . " 
                      SET tlh_cupo = :cupos 
                      WHERE tlh_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $data['tlh_id']);
        } else {
            $query = "INSERT INTO " . $this->table_disponibles . " 
                      (tlh_fecha, tlh_bloque_horario, tlh_tramite, tlh_prioidad, tlh_cupo) 
                      VALUES (:fecha, :bloque, :tlh_tramite, :prioidad, :cupos)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":fecha", $data['tlh_fecha']);
            $stmt->bindParam(":bloque", $data['tlh_bloque_horario']);
            $stmt->bindParam(":tlh_tramite", $data['tlh_tramite']);
            $stmt->bindParam(":prioidad", $data['tlh_prioidad']);
            $stmt->bindParam(":cupos", $data['tlh_cupo']);
        }

        $stmt->bindParam(":cupos", $data['tlh_cupo']);
        return $stmt->execute();
    }
}
