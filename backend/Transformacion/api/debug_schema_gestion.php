<?php
header("Content-Type: text/plain");
$pdo = new PDO('mysql:host=localhost;dbname=transformacion_digital;charset=utf8mb4', 'root', 'root');
echo "--- trd_oirs_gestion ---\n";
$stmt = $pdo->query('SHOW COLUMNS FROM trd_oirs_gestion');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
