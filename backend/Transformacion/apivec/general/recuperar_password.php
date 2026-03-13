<?php
require_once 'cors.php';
require_once 'app_autoload.php';

$autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\general_vecinosauthcontroller;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['ACCION'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'ACCION requerida'], JSON_UNESCAPED_UNICODE);
    exit;
}

$authController = new general_vecinosauthcontroller($db);

if ($data['ACCION'] === "SOLICITAR_RECUPERACION") {
    $email = $data['email'] ?? '';
    if (empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email requerido'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $result = $authController->requestPasswordReset($email);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($data['ACCION'] === "RESTABLECER_PASSWORD") {
    $token = $data['token'] ?? '';
    $password = $data['password'] ?? '';
    if (empty($token) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Token y Password requeridos'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $result = $authController->resetPassword($token, $password);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida'], JSON_UNESCAPED_UNICODE);
exit;
