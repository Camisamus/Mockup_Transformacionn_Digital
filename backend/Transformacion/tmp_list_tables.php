<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo "Tables:\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    print_r($tables);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
