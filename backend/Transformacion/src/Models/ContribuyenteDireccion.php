<?php
namespace App\Models;

use PDO;

class ContribuyenteDireccion
{
    private $conn;
    private $table_name = "trd_cont_direcciones";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tcd_contribuyente=:tcd_contribuyente,
            tcd_tipo_direccion=:tcd_tipo_direccion,
            tcd_calle=:tcd_calle,
            tcd_numero=:tcd_numero,
            tcd_departamento=:tcd_departamento,
            tcd_casa=:tcd_casa,
            tcd_aclaratoria=:tcd_aclaratoria,
            tcd_latitud=:tcd_latitud,
            tcd_longitud=:tcd_longitud";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":tcd_contribuyente", $data['tcd_contribuyente']);
        $stmt->bindValue(":tcd_tipo_direccion", $data['tcd_tipo_direccion'] ?? 'Particular');
        $stmt->bindValue(":tcd_calle", $data['tcd_calle']);
        $stmt->bindValue(":tcd_numero", $data['tcd_numero'] ?? null);
        $stmt->bindValue(":tcd_departamento", $data['tcd_departamento'] ?? null);
        $stmt->bindValue(":tcd_casa", $data['tcd_casa'] ?? null);
        $stmt->bindValue(":tcd_aclaratoria", $data['tcd_aclaratoria'] ?? null);
        $stmt->bindValue(":tcd_latitud", $data['tcd_latitud'] ?? null);
        $stmt->bindValue(":tcd_longitud", $data['tcd_longitud'] ?? null);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
}
