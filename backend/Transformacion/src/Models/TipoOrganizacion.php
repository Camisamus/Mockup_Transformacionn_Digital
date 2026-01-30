<?php
namespace App\Models;

use PDO;

class TipoOrganizacion
{
    private $conn;
    private $table_name = "trd_general_tipos_organizacion";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tor_borrado = 0 ORDER BY tor_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
