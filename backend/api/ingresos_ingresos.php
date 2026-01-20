<?php
require_once 'cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\Ingresos_SolicitudControler;

$database = new Database();
$db = $database->getConnection();

$controller = new Ingresos_SolicitudControler($db);

$id = $data['ing_id'] ?? null;
$rgt_id = $data['rgt_id'] ?? null;

switch ($data['ACCION']) {
    case 'CONSULTAM':
        if ($id) {
            $response = $controller->getById($id);
        } elseif ($rgt_id) {
            $response = $controller->getByRgtId($rgt_id);
        } else {
            // Support for Bandeja Search Filters
            $filters = [
                'tis_titulo' => $data['tis_titulo'] ?? null,
                'rgt_id_publica' => $data['rgt_id_publica'] ?? null,
                'tis_id' => $data['tis_id'] ?? null
            ];
            $response = $controller->getAll($filters);
        }
        echo json_encode($response);
        break;

    case 'CREAR':
        if ($data) {
            $response = $controller->create($data);
        } else {
            $response = ["status" => "error", "message" => "Invalid input"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR':
        if ($id && $data) {
            $response = $controller->update($id, $data);
        } else {
            $response = ["status" => "error", "message" => "ID and Data required for update"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR_ESTADO':
        if ($id && isset($data['ing_estado_entrega'])) {
            // Simplified call - we can either update Controller or call Model directly if Controller is thin
            // For consistency, let's assume we might need a controller method or just use the model if it's simpler
            $solicitudModel = new \App\Models\Ingresos_ingreso($db);
            if ($solicitudModel->updateStatus($id, $data['ing_estado_entrega'])) {
                $response = ["status" => "success", "message" => "Estado actualizado"];
            } else {
                $response = ["status" => "error", "message" => "Error al actualizar estado"];
            }
        } else {
            $response = ["status" => "error", "message" => "ID and Estado required"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if ($id) {
            $response = $controller->delete($id);
        } else {
            $response = ["status" => "error", "message" => "ID required for delete"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Action not allowed"]);
        break;
}
?>