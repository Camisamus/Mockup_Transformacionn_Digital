<?php
require_once '../general/cors.php';
require_once '../general/session_start.php';

require_once '../../src/Config/Database.php';
require_once '../../src/Models/oirs/gestion.php';
require_once '../../src/Models/Bitacora.php'; // Dependency of OIRS_Gestion

use App\Config\Database;
use App\Models\OIRS_Gestion;

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Acceso no autorizado"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();
$oirs = new OIRS_Gestion($db);

$view = $_GET['view'] ?? 'bandeja';
$userId = $_SESSION['user_id'];

try {
    $data = $oirs->getOirsByView($userId, $view);

    echo json_encode([
        "status" => "success",
        "data" => $data,
        "count" => count($data)
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
