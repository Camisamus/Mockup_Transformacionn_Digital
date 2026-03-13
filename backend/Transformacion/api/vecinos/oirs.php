<?php
require_once __DIR__ . '/../../apivec/general/auth_check_vecinos.php';

use App\Controllers\oirs_solicitudcontroller;
use App\Controllers\oirs_tipoatencioncontroller;
use App\Controllers\oirs_tematicacontroller;
use App\Controllers\oirs_subtematicacontroller;

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$id_vecino = $_SESSION['vecino_id'] ?? null;

if (!$id_vecino) {
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

$solicitudCtrl = new oirs_solicitudcontroller($db);

$accion = $_GET['accion'] ?? $data['accion'] ?? '';

switch ($accion) {
    case 'LISTAR':
        $result = $solicitudCtrl->getByContribuyente($id_vecino);
        echo json_encode($result);
        break;

    case 'RESUMEN':
        $result = $solicitudCtrl->getSummaryByContribuyente($id_vecino);
        echo json_encode($result);
        break;

    case 'NUEVA':
        // Aquí manejaremos la creación desde el punto de vista del vecino
        $data['rgt_creador'] = $id_vecino; // Para el vecino, el 'creador' es él mismo en este contexto (o mapeado a un sistema)
        $data['cont_rut'] = $_SESSION['vecino_rut']; 
        $result = $solicitudCtrl->create($data);
        echo json_encode($result);
        break;

    case 'GET_LISTAS':
        // Traer combos para el formulario
        $atencionCtrl = new oirs_tipoatencioncontroller($db);
        $tematicaCtrl = new oirs_tematicacontroller($db);
        $subtemeticaCtrl = new oirs_subtematicacontroller($db);

        echo json_encode([
            "status" => "success",
            "data" => [
                "tiposAtencion" => $atencionCtrl->getAll()['data'] ?? [],
                "tematicas" => $tematicaCtrl->getAll()['data'] ?? [],
                "subtematicas" => $subtemeticaCtrl->getAll()['data'] ?? []
            ]
        ]);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no válida"]);
        break;
}
