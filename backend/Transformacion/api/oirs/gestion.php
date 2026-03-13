<?php
require_once '../general/cors.php';
require_once '../general/session_start.php';
require_once '../../src/Config/Database.php';
require_once '../../src/Models/Bitacora.php';
require_once '../../src/Models/OIRS_Gestion.php';
require_once '../../src/Models/OirsAsignacion.php';
require_once '../../src/Models/OirsAsignacionComentario.php';
require_once '../../src/Controllers/OIRS_GestionController.php';

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

        if (isset($data['oig_respuesta_preliminar'])) {
            $data['oig_res_pre_origen'] = $_SESSION['user_id'] ?? 1;
            $data['oig_res_pre_fecha'] = date('Y-m-d H:i:s');
        }
        if (isset($data['oig_respuesta_tecnica'])) {
            $data['oig_res_tec_origen'] = $_SESSION['user_id'] ?? 1;
            $data['oig_res_tec_fecha'] = date('Y-m-d H:i:s');
        }
        if (isset($data['oig_notificacion_ejecucion'])) {
            $data['oig_res_not_origen'] = $_SESSION['user_id'] ?? 1;
            $data['oig_res_not_fecha'] = date('Y-m-d H:i:s');
        }

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
            $asignacionModel = new \App\Models\OirsAsignacion($db);

            // Check if already assigned to this cargo
            if ($asignacionModel->checkDuplicate($solicitud_id, $data['oig_asignacion'])) {
                echo json_encode(["status" => "error", "message" => "Este cargo ya tiene asignada esta solicitud."]);
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
            echo json_encode(["status" => "error", "message" => "Cargo no seleccionado"]);
        }

        break;

    case 'CONSULTA_SOLICITUD':
        $solicitud_id = $data['id'] ?? null;
        $response = $controller->getBySolicitud($solicitud_id);
        echo json_encode($response);
        break;

    case 'ASIGNACION_COMENTAR':
        $asignacion_id = $data['oac_asignacion'] ?? null;
        if (!$asignacion_id) {
            echo json_encode(["status" => "error", "message" => "ID de asignación es requerido"]);
            break;
        }

        $comentarioModel = new \App\Models\OirsAsignacionComentario($db);
        $result = $comentarioModel->crear([
            'oac_asignacion' => $asignacion_id,
            'oac_emisor' => $_SESSION['user_id'] ?? 1,
            'oac_mensaje' => $data['oac_mensaje'] ?? '',
            'oac_marcado' => $data['oac_marcado'] ?? 0
        ]);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "Comentario registrado"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar comentario"]);
        }
        break;

    case 'ASIGNACION_HISTORIAL':
        $asignacion_id = $data['oac_asignacion'] ?? null;
        if (!$asignacion_id) {
            echo json_encode(["status" => "error", "message" => "ID de asignación es requerido"]);
            break;
        }

        $comentarioModel = new \App\Models\OirsAsignacionComentario($db);
        $historial = $comentarioModel->obtenerPorAsignacion($asignacion_id);
        echo json_encode(["status" => "success", "data" => $historial]);
        break;

    case 'ELIMINAR_ASIGNACION':
        $asignacion_id = $data['oia_id'] ?? null;
        if (!$asignacion_id) {
            echo json_encode(["status" => "error", "message" => "ID de asignación es requerido"]);
            break;
        }

        $asignacionModel = new \App\Models\OirsAsignacion($db);
        if ($asignacionModel->eliminar($asignacion_id)) {
            echo json_encode(["status" => "success", "message" => "Asignación eliminada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar la asignación"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
