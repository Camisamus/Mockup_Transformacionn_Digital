<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo "Areas:\n";
    $stmt = $pdo->query("SELECT tga_id, tga_nombre FROM trd_general_areas LIMIT 10");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    
    echo "\nTotal Cargos: " . $pdo->query("SELECT COUNT(*) FROM trd_general_cargos")->fetchColumn() . "\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
