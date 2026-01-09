<?php
require_once 'cors.php';

// API Endpoint: Funcionarios
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\FuncionarioController;

$database = new Database();
$db = $database->getConnection();

$controller = new FuncionarioController($db);

switch ($data['ACCION']) {
    case 'CONSULTAM':
        $response = $controller->getAll();
        echo json_encode($response);
        break;

    // CREAR case removed as per requirement to disable creation of officials


    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
?>