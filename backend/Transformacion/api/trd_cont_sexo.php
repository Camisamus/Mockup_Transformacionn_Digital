<?php
require_once 'cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\ContribuyenteSexoController;

$database = new Database();
$db = $database->getConnection();

$controller = new ContribuyenteSexoController($db);

$data = json_decode(file_get_contents("php://input"), true);
$action = $data['ACCION'] ?? '';

switch ($action) {
    case 'CONSULTAM':
        echo json_encode($controller->getAll());
        break;
    default:
        // Also allow GET or default to getAll if no action provided (for flexibility)
        // usage in frontend is with ACCION: CONSULTAM
        echo json_encode($controller->getAll());
        break;
}
