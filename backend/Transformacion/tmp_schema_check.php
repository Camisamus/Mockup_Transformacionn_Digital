<?php
// Try to get schema without relying on Dotenv if possible
$host = 'localhost';
$db   = 'transformacion_digital';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Columns in trd_general_cargos:\n";
     $stmt = $pdo->query("SHOW COLUMNS FROM trd_general_cargos");
     while($row = $stmt->fetch()) {
         echo $row['Field'] . " (" . $row['Type'] . ")\n";
     }
} catch (\PDOException $e) {
     echo "Error: " . $e->getMessage();
}
?>
