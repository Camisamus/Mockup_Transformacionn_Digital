<?php
$host = '127.0.0.1'; // Try IP instead of localhost
$db   = 'transformacion_digital';
$user = 'root';
$pass = ''; // Try empty
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
     $pdo = new PDO($dsn, $user, $pass);
     $stmt = $pdo->query("SHOW COLUMNS FROM trd_general_cargos");
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         echo $row['Field'] . "\n";
     }
} catch (\PDOException $e) {
     echo "Error: " . $e->getMessage();
}
?>
