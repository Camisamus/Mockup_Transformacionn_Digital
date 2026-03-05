<?php
require_once '../general/cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Helpers\Encode;
$String = $data['ID'] ?? null;

switch ($data['ACCION']) {
    case 'DO':
        $encode = new Encode();
        $response = $encode->cifrar($String);
        echo json_encode($response);
        break;
    case 'UNDO':
        $encode = new Encode();
        $response = $encode->descifrar($String);
        echo json_encode($response);
        break;
    case 'UNDOMASIVO':
        $encode = new Encode();
        $response = $encode->descifrarMasivo($String);
        echo json_encode($response);
        break;
}