<?php

namespace App\Models;

use PDO;
use Exception;

class Bitacora
{
    private $conn;
    private $table_name = "trd_general_bitacora";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Registra un evento en la bitácora
     * 
     * @param int $tramite_id ID del trámite en trd_general_registro_general_tramites
     * @param string $evento Descripción del evento
     * @param int|null $responsable_id ID del usuario responsable
     * @return bool
     */
    public function registrar($tramite_id, $evento, $responsable_id = null)
    {
        if (!$responsable_id) {
            $responsable_id = $_SESSION['user_id'] ?? null;
        }

        if (!$responsable_id) {
            // Fallback to first user for system events if no session (should be avoided)
            $responsable_id = 1;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  (`bit_tramite_registrado`, `bit_evento`, `bit-responsable`, `bit_fecha`) 
                  VALUES (:tramite_id, :evento, :responsable, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        $stmt->bindParam(':evento', $evento);
        $stmt->bindParam(':responsable', $responsable_id);

        return $stmt->execute();
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
                  JOIN trd_acceso_usuarios u ON b.`bit-responsable` = u.usr_id
                  WHERE b.bit_tramite_registrado = :tramite_id 
                  ORDER BY b.bit_fecha ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tramite_id', $tramite_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
