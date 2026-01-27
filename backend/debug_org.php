<?php
// backend/debug_org.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\Database;
use App\Models\OrganizacionComunitariaGeneral;

try {
    echo "Connecting to DB...\n";
    $database = new Database();
    $db = $database->getConnection();
    echo "Connected.\n";

    echo "Instantiating Model...\n";
    $org = new OrganizacionComunitariaGeneral($db);

    echo "Calling getAll()...\n";
    $data = $org->getAll();

    echo "Data retrieved:\n";
    print_r($data);

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
?>