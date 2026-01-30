<?php
namespace App\Models;

use PDO;

class Comentario
{
    private $conn;
    private $table_name = "trd_general_comentario";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    public function getByRegistroId($rgt_id)
    {
        $query = "SELECT c.*, u.usr_nombre, u.usr_apellido 
                  FROM " . $this->table_name . " c
                  LEFT JOIN trd_acceso_usuarios u ON c.gco_comentador = u.usr_id
                  WHERE c.gco_tramite = :rgt_id 
                  ORDER BY c.gco_fecha DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":rgt_id", $rgt_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
                  gco_tramite = :rgt_id,
                  gco_comentario = :gco_texto,
                  gco_comentador = :gco_usuario,
                  gco_fecha = :gco_fecha";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":rgt_id", $data['rgt_id']);
        $stmt->bindValue(":gco_texto", $data['gco_texto']);
        $stmt->bindValue(":gco_usuario", $data['gco_usuario']);
        $stmt->bindValue(":gco_fecha", date('Y-m-d H:i:s'));

        if ($stmt->execute()) {
            // Registrar en bitácora
            $this->bitacora->registrar($data['rgt_id'], "Añade comentario al trámite", $data['gco_usuario']);
            return true;
        }
        return false;
    }
}
