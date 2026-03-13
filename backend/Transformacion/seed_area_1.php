<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Create cargos for Area 1 (trdig)
    $cargos = [
        ['Director Transformacion Digital', 1, 2],
        ['Analista Programador', 1, 1],
        ['Soporte Tecnico', 1, 1]
    ];
    
    foreach($cargos as $c) {
        $stmt = $pdo->prepare("INSERT INTO trd_general_cargos (car_nombre, car_area, car_nivel) VALUES (?, ?, ?)");
        $stmt->execute($c);
    }
    echo "Cargos for Area 1 created.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
