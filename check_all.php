<?php
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
$db = (new App\Config\Database())->getConnection();

function checkTable($db, $table) {
    echo "--- ESQUEMA DE $table ---\n";
    $stmt = $db->query("DESCRIBE $table");
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row['Field'] . " | " . $row['Type'] . "\n";
    }
}

checkTable($db, 'trd_desecon_docentregada');
echo "\n";
checkTable($db, 'trd_desecon_emprendimientos');

echo "\n--- ÚLTIMOS REGISTROS EN trd_desecon_emprendimientos ---\n";
$stmt = $db->query("SELECT dee_rut, dee_img_portada, dee_img_logo FROM trd_desecon_emprendimientos ORDER BY dee_creacion DESC LIMIT 5");
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo "RUT: {$row['dee_rut']} | Portada: {$row['dee_img_portada']} | Logo: {$row['dee_img_logo']}\n";
}
