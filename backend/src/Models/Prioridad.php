<?php
namespace App\Models;

use PDO;

class Prioridad
{
    private $conn;
    private $table_name = "trd_ingresos_prioridades";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE pri_borrado = 0 ORDER BY pri_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
