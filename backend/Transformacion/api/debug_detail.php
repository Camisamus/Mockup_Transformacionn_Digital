<?php
header("Content-Type: text/plain");
$host = 'localhost';
$db_name   = 'transformacion_digital';
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $pass);
    echo "Detail of sol ID 1:\n";
    $stmt = $pdo->query("SELECT * FROM trd_ingresos_solicitudes WHERE tis_id = 1");
    print_r($stmt->fetch(PDO::FETCH_ASSOC));
    
    echo "\nDestinations of sol ID 1:\n";
    $stmt = $pdo->query("SELECT * FROM trd_ingresos_destinos WHERE tid_ingreso_solicitud = 1");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) { echo $e->getMessage(); }
?>
