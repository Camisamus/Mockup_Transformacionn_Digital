<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Columnas de trd_oirs_tematicas:\n";
    $cols = $db->query("SHOW FULL COLUMNS FROM trd_oirs_tematicas")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
