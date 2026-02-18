<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'session_start.php';
require_once '../src/Config/Database.php';
require_once '../src/Models/Bitacora.php';
require_once '../src/Models/OIRS_Gestion.php';
require_once '../src/Controllers/OIRS_GestionController.php';

use App\Config\Database;
use App\Controllers\OIRS_GestionController;

$database = new Database();
$db = $database->getConnection();

$controller = new OIRS_GestionController($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['ACCION'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Datos incompletos o ACCION no especificada"]);
    exit;
}

switch ($data['ACCION']) {
    case 'ACTUALIZAR':
        $solicitud_id = $data['oig_solicitud'] ?? null;
        if (!$solicitud_id) {
            echo json_encode(["status" => "error", "message" => "ID de solicitud es requerido"]);
            break;
        }
        $data['creador_id'] = $_SESSION['user_id'] ?? 1;


        $response = $controller->update($solicitud_id, $data);
        echo json_encode($response);
        break;
    case 'ASIGNAR':
        $solicitud_id = $data['oig_solicitud'] ?? null;
        if (!$solicitud_id) {
            echo json_encode(["status" => "error", "message" => "ID de solicitud es requerido"]);
            break;
        }
        $data['creador_id'] = $_SESSION['user_id'] ?? 1;

        // Handle Assignment Creation (History)
        if (!empty($data['oig_asignacion'])) {
            require_once '../src/Models/OirsAsignacion.php';
            $asignacionModel = new \App\Models\OirsAsignacion($db);

            // Check if already assigned to this official
            if ($asignacionModel->checkDuplicate($solicitud_id, $data['oig_asignacion'])) {
                echo json_encode(["status" => "error", "message" => "El funcionario ya tiene asignada esta solicitud."]);
                break;
            }

            $asignacionResult = $asignacionModel->crear([
                'solicitud' => $solicitud_id,
                'funcionario' => $data['oig_asignacion'],
                'instruccion' => $data['oig_instruccion_asignacion'] ?? null
            ]);

            if ($asignacionResult) {
                // Also update the main request to reflect current assignment if needed, 
                // or just return success of the assignment
                echo json_encode(["status" => "success", "message" => "Asignación realizada exitosamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al crear la asignación"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Funcionario no seleccionado"]);
        }

        break;

    case 'CONSULTA_SOLICITUD':
        $solicitud_id = $data['id'] ?? null;
        $response = $controller->getBySolicitud($solicitud_id);
        echo json_encode($response);
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
