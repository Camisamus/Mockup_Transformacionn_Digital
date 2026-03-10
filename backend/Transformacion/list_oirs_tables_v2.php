<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Tablas OIRS:\n";
    $tables = $db->query("SHOW TABLES LIKE 'trd_oirs_%'")->fetchAll(PDO::FETCH_COLUMN);
    print_r($tables);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
