<?php
require_once 'cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");

use App\Config\Database;
use App\Controllers\AuthController;
use App\Controllers\BandejaController;

$database = new Database();
$db = $database->getConnection();

// 1. Verify Authentication
$authController = new AuthController($db);
if (!$authController->isAuthenticated()) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

// 2. Handle Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Sesión inválida"]);
        exit;
    }

    $controller = new BandejaController($db);
    $inbox = $controller->getInbox($userId);

    echo json_encode([
        "status" => "success",
        "data" => $inbox
    ]);

} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>