<?php
namespace App\Models;

use PDO;

class Sector
{
    private $conn;
    private $table_name = "trd_general_sectores";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sec_borrado = 0 ORDER BY sec_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
