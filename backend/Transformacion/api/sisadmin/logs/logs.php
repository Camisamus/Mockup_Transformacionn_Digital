<?php

require_once '../../general/cors.php';
require_once '../../../src/Config/Database.php';
require_once '../../../src/Models/general_logs.php';
require_once '../../../src/Controllers/general_systemlogcontroller.php';

use App\Config\Database;
use App\Controllers\general_systemlogcontroller;

// Iniciar sesión para verificar permisos (opcional pero recomendado)


// Validar que el usuario sea administrador o tenga permisos (simplificado)
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$controller = new general_systemlogcontroller($db);
$controller->handleRequest($_SERVER['REQUEST_METHOD']);
