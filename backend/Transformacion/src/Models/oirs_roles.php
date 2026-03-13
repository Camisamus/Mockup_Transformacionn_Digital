<?php
namespace App\Models;

use PDO;

class oirs_roles
{
    private $conn;
    private $table_name = "trd_oirs_funcionarios_areas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT ro.*, u.usr_nombre as usuario_nombre, u.usr_apellido as usuario_apellid,
                   a.tga_nombre as area_nombre
                   FROM " . $this->table_name . " ro
                   JOIN trd_acceso_usuarios u ON ro.ofa_funcionario = u.usr_id
                   JOIN trd_general_areas a ON ro.ofa_area = a.tga_id
                   WHERE (ro.ofa_borrado = 0 OR ro.ofa_borrado IS NULL)
                   ORDER BY u.usr_apellido ASC, a.tga_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            ofa_funcionario=:ofa_funcionario,
            ofa_area=:ofa_area,
            ofa_p=:ofa_p,
            ofa_borrado=0";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":ofa_funcionario", $data['ofa_funcionario']);
        $stmt->bindParam(":ofa_area", $data['ofa_area']);
        $stmt->bindParam(":ofa_p", $data['ofa_p']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($ofa_funcionario, $ofa_area, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            ofa_funcionario=:ofa_funcionario,
            ofa_area=:ofa_area,
            ofa_p=:ofa_p
            WHERE ofa_funcionario=:ofa_funcionario AND ofa_area=:ofa_area";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":ofa_funcionario", $ofa_funcionario);
        $stmt->bindParam(":ofa_area", $ofa_area);
        $stmt->bindParam(":ofa_p", $data['ofa_p']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($ofa_funcionario, $ofa_area)
    {
        $query = "UPDATE " . $this->table_name . " SET ofa_borrado = 1
                  WHERE ofa_funcionario = :ofa_funcionario AND ofa_area = :ofa_area";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ofa_funcionario", $ofa_funcionario);
        $stmt->bindParam(":ofa_area", $ofa_area);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
