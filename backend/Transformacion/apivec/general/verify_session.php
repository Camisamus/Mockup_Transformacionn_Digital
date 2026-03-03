<?php
require_once __DIR__ . '/cors.php';

require_once __DIR__ . '/app_autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\VecinosAuthController;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode([
        'isAuthenticated' => false,
        'success' => false,
        'message' => 'Error de conexión a la base de datos'
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$googleToken = $data['google_token'] ?? null;

$authController = new VecinosAuthController($db);
$isAuthenticated = $authController->isAuthenticated();

if ($isAuthenticated) {
    echo json_encode([
        'isAuthenticated' => true,
        'user' => [
            'id' => $_SESSION['vecino_id'] ?? null,
            'email' => $_SESSION['vecino_email'] ?? null,
            'nombre' => $_SESSION['vecino_nombre'] ?? null,
            'apellido' => $_SESSION['vecino_apellido'] ?? null,
            'user_type' => 'vecino'
        ]
    ]);
} else {
    echo json_encode([
        'isAuthenticated' => false,
        'success' => false,
        'message' => 'No autorizado',
        'debug' => [
            'session_id' => session_id(),
            'has_session_id' => isset($_SESSION['user_id'])
        ]
    ]);
}
exit;

