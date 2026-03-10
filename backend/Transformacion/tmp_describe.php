<?php
require_once 'src/Config/Database.php';
use App\Config\Database;
$db = (new Database())->getConnection();
$tables = ['trd_general_contribuyentes', 'trd_acceso_vecinos'];
foreach ($tables as $table) {
    echo "--- $table ---\n";
    $stmt = $db->query("DESCRIBE $table");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']}\n";
    }
}