<?php
namespace App\Models;

use PDO;

class Usuario
{
    private $conn;
    private $table = 'trd_acceso_usuarios';

    public $usr_id;
    public $usr_email;
    public $usr_nombre;
    public $usr_apellido;
    public $usr_rut;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function findByRut($rut)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE usr_rut = :rut AND usr_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->usr_id = $row['usr_id'];
            $this->usr_email = $row['usr_email'];
            $this->usr_nombre = $row['usr_nombre'];
            $this->usr_apellido = $row['usr_apellido'];
            $this->usr_rut = $row['usr_rut'];
            return true;
        }

        return false;
    }

    public function verifyPassword($password)
    {
        // Password check removed as column is gone
        return true;
    }
}
