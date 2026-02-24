<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Models\OrganizacionComunitariaGeneral;

$database = new Database();
$db = $database->getConnection();

$model = new OrganizacionComunitariaGeneral($db);
$data = $model->getAll();

echo "--- Organizaciones Comunitarias (Top 1) ---\n";
if (!empty($data)) {
    print_r($data[0]);
} else {
    echo "No records found.\n";
}
?>