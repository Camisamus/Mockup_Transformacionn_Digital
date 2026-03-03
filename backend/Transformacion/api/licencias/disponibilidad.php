<?php
require_once '../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");

use App\Config\Database;
use App\Models\LicenciaHoras;
use App\Helpers\LicenciasHelper;

$database = new Database();
$db = $database->getConnection();

$model = new LicenciaHoras($db);

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

if (!isset($data['ACCION'])) {
    echo json_encode(["status" => "error", "message" => "Acción no especificada"]);
    exit;
}

switch ($data['ACCION']) {
    case 'GET_VULNERABILIDADES':
        $res = $model->getVulnerabilidades();
        echo json_encode(["status" => "success", "data" => $res]);
        break;

    case 'GET_DISPONIBILIDAD':
        if (!isset($data['fecha']) || !isset($data['tra_id'])) {
            echo json_encode(["status" => "error", "message" => "Fecha y ID de trámite requeridos"]);
            break;
        }
        // El modelo getDisponibilidadPorFecha debe retornar tlh_id para poder editar después
        $res = $model->getDisponibilidadPorFecha($data['fecha'], $data['tra_id']);
        echo json_encode(["status" => "success", "data" => $res]);
        break;

    case 'GUARDAR_DISPONIBILIDAD':
        // Validar datos mínimos
        if (!isset($data['tlh_fecha'], $data['tlh_bloque_horario'], $data['tra_id'], $data['tlh_vulnerable'], $data['tlh_cupo'])) {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
            break;
        }

        // Verificar si ya existe para edición
        $existente = $model->findRegistro($data['tlh_fecha'], $data['tlh_bloque_horario'], $data['tra_id'], $data['tlh_vulnerable']);
        if ($existente) {
            $data['tlh_id'] = $existente['tlh_id'];
        }

        if ($model->save($data)) {
            echo json_encode(["status" => "success", "message" => "Disponibilidad guardada"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo guardar"]);
        }
        break;

    case 'GUARDAR_MASIVO':
        if (!isset($data['fechas'], $data['tlh_bloque_horario'], $data['tra_id'], $data['tlh_vulnerable'], $data['tlh_cupo'])) {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
            break;
        }

        $errores = 0;
        foreach ($data['fechas'] as $fecha) {
            $registro = [
                'tlh_fecha' => $fecha,
                'tlh_bloque_horario' => $data['tlh_bloque_horario'],
                'tra_id' => $data['tra_id'],
                'tlh_vulnerable' => $data['tlh_vulnerable'],
                'tlh_cupo' => $data['tlh_cupo'],
                'tlh_tramite' => $data['tra_id']
            ];

            $existente = $model->findRegistro($fecha, $data['tlh_bloque_horario'], $data['tra_id'], $data['tlh_vulnerable']);
            if ($existente) {
                $registro['tlh_id'] = $existente['tlh_id'];
            }

            if (!$model->save($registro)) {
                $errores++;
            }
        }

        if ($errores === 0) {
            echo json_encode(["status" => "success", "message" => "Registros guardados correctamente"]);
        } else {
            echo json_encode(["status" => "warning", "message" => "Se completó con $errores errores"]);
        }
        break;

    case 'GET_BLOQUES':
        $bloques = LicenciasHelper::obtenerDiccionarioBloques();
        echo json_encode(["status" => "success", "data" => $bloques]);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Acción no reconocida"]);
        break;
}
?>