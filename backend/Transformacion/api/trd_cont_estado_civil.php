<?php
require_once 'cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\ContribuyenteEstadoCivilController;

$database = new Database();
$db = $database->getConnection();

$controller = new ContribuyenteEstadoCivilController($db);

$data = json_decode(file_get_contents("php://input"), true);
$action = $data['ACCION'] ?? '';

switch ($action) {
    case 'CONSULTAM':
        echo json_encode($controller->getAll());
        break;
    default:
        echo json_encode($controller->getAll());
        break;
}
