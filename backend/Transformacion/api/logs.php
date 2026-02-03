<?php

require_once 'cors.php';
require_once '../src/Config/Database.php';
require_once '../src/Models/SystemLog.php';
require_once '../src/Controllers/SystemLogController.php';

use App\Config\Database;
use App\Controllers\SystemLogController;

// Iniciar sesión para verificar permisos (opcional pero recomendado)


// Validar que el usuario sea administrador o tenga permisos (simplificado)
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$controller = new SystemLogController($db);
$controller->handleRequest($_SERVER['REQUEST_METHOD']);
