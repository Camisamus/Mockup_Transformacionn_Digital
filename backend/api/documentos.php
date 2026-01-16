<?php

require_once '../api/cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\DocumentoController;
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$documentoController = new DocumentoController($db);

// Asumimos que $data viene de cors.php (decodificación de JSON)
$accion = $data['ACCION'] ?? $_POST['ACCION'] ?? '';

switch ($accion) {
    case 'Subir':
        // Verificamos que venga el archivo
        if (isset($_FILES['archivo'])) {
            // Unimos los datos de $_POST y el archivo
            $resultado = $documentoController->create($_POST, $_FILES['archivo']);
            echo json_encode($resultado);
        } else {
            echo json_encode(["status" => "error", "message" => "No se recibió ningún archivo"]);
        }
        break;
    case 'Bajar':
        $id = $data['ID'] ?? null;
        if ($id) {
            // Esta función ya contiene los header() y el exit;
            $documentoController->getByIDAndDownload($id);
        }
        break;

    case 'BuscarporTramite':
        $tramite_id = $data['tramite_id'] ?? '';
        $resultado = $documentoController->getAll($tramite_id);
        echo json_encode($resultado);
        break;

    case 'BuscarporID':
        $id = $data['id'] ?? '';
        $resultado = $documentoController->getByIDAndDownload($id);
        echo json_encode($resultado);
        break;
    case 'Borrar':
        $id = $data['id'] ?? '';
        $resultado = $documentoController->delete($id);
        echo json_encode($resultado);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}