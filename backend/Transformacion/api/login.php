<?php
require_once 'cors.php';


$autoload = __DIR__ . '/../vendor/autoload.php';


if (!file_exists($autoload)) {
    http_response_code(500);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(['message' => 'Dependencies missing: run composer install']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\AuthController;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error de conexión a la base de datos'
    ]);
    exit;
}

$authController = new AuthController($db);

if (!isset($data['email']) || !isset($data['ACCION']) || $data['ACCION'] !== "LOGIN") {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Email y ACCION LOGIN requeridos'
    ]);
    exit;
}

$result = $authController->loginByEmail($data['email']);

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Login exitoso',
        'data' => [
            'user' => $result['user']
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => $result['message']
    ]);
}
exit;

// $result = $authController->login($data['usuario'], $data['password']);
// if ($result['success']) {
//     http_response_code(200);
//     // DEBUG: Add session info to response
//     $result['debug_session_id'] = session_id();
//     $result['debug_session_data'] = $_SESSION;
// } else {
//     http_response_code(401);
// }

// echo json_encode($result);

