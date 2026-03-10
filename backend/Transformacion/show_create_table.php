<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    $res = $db->query("SHOW CREATE TABLE trd_oirs_funcionarios_areas")->fetch(PDO::FETCH_ASSOC);
    echo $res['Create Table'];
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
