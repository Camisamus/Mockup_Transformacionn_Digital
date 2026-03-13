<?php
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
$db = (new App\Config\Database())->getConnection();
$stmt = $db->query("DESCRIBE trd_desecon_docentregada");
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo $row['Field'] . " | " . $row['Type'] . "\n";
}
echo "---\n";
$stmt = $db->query("SELECT * FROM trd_desecon_docentregada ORDER BY dee_id DESC LIMIT 5");
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo "ID: " . $row['dee_id'] . " | Name: " . $row['dee_nombre'] . " | Doc: " . $row['dee_documento'] . "\n";
}
