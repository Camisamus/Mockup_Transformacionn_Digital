<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT * FROM trd_general_cargos");
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Cargos:\n";
    print_r($res);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
