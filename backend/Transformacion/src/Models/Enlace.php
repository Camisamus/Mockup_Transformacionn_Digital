<?php

namespace App\Models;

use PDO;
use Exception;

class Enlace
{
    private $conn;
    private $table_name = "trd_general_enlaces";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Registra un evento en la bitácora
     * 
     * @param int $org_id ID del trámite en trd_general_registro_general_tramites
     * @param string $evento Descripción del evento
     * @param int|null $responsable_id ID del usuario responsable
     * @return bool
     */
    public function subir($tramite_id, $doc_enlace_documento, $responsable_id = null)
    {
        if (!$responsable_id) {
            $responsable_id = $_SESSION['user_id'] ?? null;
        }

        if (!$responsable_id) {
            // Fallback to first user for system events if no session (should be avoided)
            $responsable_id = 1;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  (`tge_tramite`, `tge_enlace`, `tge_responsable`, `tge_fecha`) 
                  VALUES (:tramite_id, :tge_enlace, :tge_responsable, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        $stmt->bindParam(':tge_enlace', $doc_enlace_documento);
        $stmt->bindParam(':tge_responsable', $responsable_id);

        return $stmt->execute();
    }

    /**
     * Obtiene la bitácora completa de un trámite
     * 
     * @param int $tramite_id
     * @return array
     */
    public function obtenerPorRegistroId($tramite_id)
    {
        $query = "SELECT b.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " b
                  JOIN trd_acceso_usuarios u ON b.`tge_responsable` = u.usr_id
                  WHERE b.tge_tramite = :tramite_id 
                  ORDER BY b.tge_fecha ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerId($id)
    {
        $query = "SELECT b.* 
                  FROM " . $this->table_name . " b
                  WHERE b.doc_id = :id ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function borrar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE tge_id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function borrarPorTramiteId($tramite_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE tge_tramite = :tramite_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        return $stmt->execute();
    }
}
