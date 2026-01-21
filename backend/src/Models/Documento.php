<?php

namespace App\Models;

use PDO;
use Exception;

class Documento
{
    private $conn;
    private $table_name = "trd_general_documento_adjunto";

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
    public function subir($tramite_id, $doc_enlace_documento, $doc_nombre_documento, $responsable_id = null, $es_docdigital = null)
    {
        if (!$responsable_id) {
            $responsable_id = $_SESSION['user_id'] ?? null;
        }

        if (!$responsable_id) {
            // Fallback to first user for system events if no session (should be avoided)
            $responsable_id = 1;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  (`doc_tramite_registrado`, `doc_enlace_documento`, `doc_nombre_documento`, `doc-responsable`, `doc_docdigital`, `doc_fecha`) 
                  VALUES (:tramite_id, :doc_enlace_documento, :doc_nombre_documento, :responsable, :doc_docdigital, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        $stmt->bindParam(':doc_enlace_documento', $doc_enlace_documento);
        $stmt->bindParam(':doc_nombre_documento', $doc_nombre_documento);
        $stmt->bindParam(':responsable', $responsable_id);
        $stmt->bindParam(':doc_docdigital', $es_docdigital);

        if (!$stmt->execute()) {
            error_log("Documento::subir Error: " . implode(" - ", $stmt->errorInfo()));
            return false;
        }
        return true;
    }

    /**
     * Obtiene la bitácora completa de un trámite
     * 
     * @param int $tramite_id
     * @return array
     */
    public function obtenerPorTramite($tramite_id)
    {
        $query = "SELECT b.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " b
                  LEFT JOIN trd_acceso_usuarios u ON b.`doc-responsable` = u.usr_id
                  WHERE b.doc_tramite_registrado = :tramite_id 
                  ORDER BY b.doc_fecha ASC";
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
                  WHERE doc_id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
