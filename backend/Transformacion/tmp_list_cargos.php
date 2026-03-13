<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT car_id, car_nombre, car_nivel FROM trd_general_cargos");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Current Cargos:\n";
    print_r($data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
