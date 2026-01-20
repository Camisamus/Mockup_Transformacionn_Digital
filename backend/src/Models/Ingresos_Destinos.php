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

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            titi_nombre=:titi_nombre";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titi_nombre", $data['titi_nombre']);

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
}
