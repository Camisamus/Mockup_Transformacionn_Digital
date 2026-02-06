<?php

require_once '../api/cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\GesDocController;
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$gesdocController = new GesDocController($db);

// Asumimos que $data viene de cors.php (decodificación de JSON)
$accion = $data['ACCION'] ?? $_POST['ACCION'] ?? '';

switch ($accion) {
    case 'Subir':
        // Verificamos si viene por $_FILES
        if (isset($_FILES['archivo'])) {
            // Adaptar para GesDocController::subirArchivo
            // GesDoc espera un array de archivos, y data con tramite_id/user_id
            $files = [$_FILES['archivo']]; // Envolver en array si es único, o pasar directo si estructura coincide

            // Recopilar datos adicionales necesarios
            $requestData = [
                'tramite_id' => $_POST['tramite_id'] ?? null,
                'user_id' => $_SESSION['user_id'] ?? 1 // Fallback si no hay sesión
            ];

            $resultado = $gesdocController->subirArchivo($files, $requestData);
            echo json_encode($resultado);
        } else {
            echo json_encode(["status" => "error", "message" => "No se recibió ningún archivo o contenido"]);
        }
        break;
    case 'Bajar':
        $id = $data['ID'] ?? null;
        if ($id) {
            $gesdocController->bajarArchivo($id);
        }
        break;

    case 'BuscarporTramite':
        $tramite_id = $data['tramite_id'] ?? '';
        $resultado = $documentoController->getAll($tramite_id);
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