<?php
header("Content-Type: text/plain");
$host = 'localhost';
$db_name   = 'transformacion_digital';
$user = 'root'; // Default XAMPP
$pass = 'root'; // Specified in Database.php

// Try common XAMPP defaults if 'root/root' fails
$configs = [
    ['host' => 'localhost', 'db' => 'transformacion_digital', 'user' => 'root', 'pass' => 'root'],
    ['host' => 'localhost', 'db' => 'transformacion_digital', 'user' => 'root', 'pass' => ''],
];

$pdo = null;
foreach($configs as $c) {
    try {
        $pdo = new PDO("mysql:host={$c['host']};dbname={$c['db']};charset=utf8mb4", $c['user'], $c['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected as {$c['user']}\n";
        break;
    } catch (PDOException $e) {
        continue;
    }
}

if (!$pdo) {
    die("Could not connect to database.");
}

echo "--- Status Table trd_ingresos_solicitudes ---\n";
$stmt = $pdo->query("SELECT tis_estado, COUNT(*) as total FROM trd_ingresos_solicitudes GROUP BY tis_estado");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Estado: [" . $row['tis_estado'] . "] -> " . $row['total'] . "\n";
}

echo "\n--- Join Check (sol.tis_registro_tramite = rgt.rgt_id) ---\n";
$stmt = $pdo->query("SELECT sol.tis_id, sol.tis_registro_tramite, rgt.rgt_id 
                     FROM trd_ingresos_solicitudes sol 
                     LEFT JOIN trd_general_registro_general_expedientes rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                     LIMIT 10");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "SolID " . $row['tis_id'] . " (FK " . ($row['tis_registro_tramite'] ?? 'NULL') . ") -> RgtID " . ($row['rgt_id'] ?? 'NULL') . "\n";
}

echo "\n--- Destination Check ---\n";
$stmt = $pdo->query("SELECT tid_destino, COUNT(*) as total FROM trd_ingresos_destinos GROUP BY tid_destino");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "UserID " . $row['tid_destino'] . " has " . $row['total'] . " destinations.\n";
}
?>
