<?php
require_once 'src/Config/Database.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

echo "Schema of trd_general_cargos:\n";
$stmt = $db->query("SHOW COLUMNS FROM trd_general_cargos");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\nSample Data:\n";
$stmt = $db->query("SELECT * FROM trd_general_cargos LIMIT 5");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
