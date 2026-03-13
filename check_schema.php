<?php
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
use App\Config\Database;

$db = (new Database())->getConnection();

echo "--- ESQUEMA DE trd_desecon_docentregada ---\n";
$stmt = $db->query("DESCRIBE trd_desecon_docentregada");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

echo "\n--- ESQUEMA DE trd_desecon_emprendimientos ---\n";
$stmt = $db->query("DESCRIBE trd_desecon_emprendimientos");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
