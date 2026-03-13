<?php
require_once 'src/Config/Database.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

try {
    // Add car_nivel column
    $db->exec("ALTER TABLE trd_general_cargos ADD COLUMN car_nivel INT DEFAULT 1");
    echo "Column car_nivel added successfully.\n";

    // Set some default values based on common names if possible, but for now let's just show it worked.
    // Example: Admin OIRS = 3, Jefes = 2, others = 1.
    // I don't know the exact IDs, so I'll just print the current table to let the user know.
    
    $stmt = $db->query("SELECT car_id, car_nombre, car_nivel FROM trd_general_cargos");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
