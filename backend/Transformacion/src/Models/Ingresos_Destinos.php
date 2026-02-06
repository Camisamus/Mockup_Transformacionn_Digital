<?php
namespace App\Models;

use PDO;

class Ingresos_Destinos
{
    private $conn;
    private $table_name_detalle = "trd_acceso_usuarios";
    private $table_name = "trd_ingresos_destinos";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY tid_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorIngresoId($id)
    {
        $query = "select 
us.usr_nombre, 
US.usr_apellido,  
us.usr_email,  
ins.* 
FROM 
" . $this->table_name . " ins 
join 
" . $this->table_name_detalle . " us 
on 
ins.tid_destino = us.usr_id 
WHERE 
ins.tid_ingreso_solicitud = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tid_ingreso_solicitud = :tid_ingreso_solicitud,
            tid_destino = :tid_destino,
            tid_tipo = :tid_tipo,
            tid_facultad = :tid_facultad,
            tid_requeido = :tid_requeido,
            tid_tarea = :tid_tarea";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tid_ingreso_solicitud", $data['tid_tramite']);
        $stmt->bindParam(":tid_destino", $data['tid_funcionario']);
        $stmt->bindParam(":tid_tipo", $data['tid_tipo']);
        $stmt->bindParam(":tid_facultad", $data['tid_facultad']);
        $stmt->bindParam(":tid_requeido", $data['tid_requeido']);
        $stmt->bindParam(":tid_tarea", $data['tid_tarea']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            titi_nombre=:titi_nombre WHERE titi_id=:titi_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titi_id", $id);
        $stmt->bindParam(":titi_nombre", $data['titi_nombre']);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
    public function borrarPorIngresoId($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE tid_ingreso_solicitud = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
