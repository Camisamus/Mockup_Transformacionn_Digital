<?php
require_once '../general/cors.php';
require_once '../general/app_autoload.php';

$autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\desecon_rubrocontroller;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
    exit;
}

$controller = new desecon_rubrocontroller($db);

$rubro_id = $_GET['rubro_id'] ?? null;

if ($rubro_id) {
    $result = $controller->getRequiredDocs($rubro_id);
} else {
    // Acción por defecto: listar todos los rubros
    $result = $controller->getAll();
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;
