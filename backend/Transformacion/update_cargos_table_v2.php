<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = ''; // As discovered in previous step

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->exec("ALTER TABLE trd_general_cargos ADD COLUMN car_nivel INT DEFAULT 1");
    echo "Column car_nivel added successfully.\n";

    $stmt = $pdo->query("SELECT car_id, car_nombre, car_nivel FROM trd_general_cargos");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
