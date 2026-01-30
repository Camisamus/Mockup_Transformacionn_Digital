<?php
require_once 'cors.php';

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\AuthController;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if ($data['ACCION'] !== "logout") {
    http_response_code(400);
    echo json_encode(['message' => 'Accion no permitida']);
    exit;
}

$authController = new AuthController($db);
$authController->logout();
echo json_encode([
    'success' => true,
    'message' => 'Sesión cerrada correctamente'
]);
