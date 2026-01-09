<?php
require_once 'cors.php';

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\AuthController;

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

$authController = new AuthController($db);
$permissions = $authController->isAuthenticated($googleToken);

if ($permissions !== false) {
    echo json_encode([
        'isAuthenticated' => true,
        'user' => [
            'id' => $_SESSION['user_id'] ?? null,
            'email' => $_SESSION['email'] ?? null,
            'nombre' => $_SESSION['nombre'] ?? null,
            'apellido' => $_SESSION['apellido'] ?? null,
            'usuario' => $_SESSION['usuario'] ?? null
        ],
        'permissions' => $permissions
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

