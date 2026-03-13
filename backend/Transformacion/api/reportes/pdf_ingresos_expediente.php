<?php
require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

use App\Config\Database;
use App\Controllers\ingresos_solicitudcontroller;
use App\Helpers\Encode;
use App\Helpers\Fechas;

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

$controller = new ingresos_solicitudcontroller($db);
$encoder = new Encode();
$fechaHelper = new Fechas();

// Get ID from the request (Support both POST/JSON and GET for direct view)
$id = $data['ID'] ?? $_GET['ID'] ?? null;

// Decrypt ID if needed
if ($id && is_string($id) && strpos($id, 'L$U') === 0) {
    $id = $encoder->descifrar($id);
}

if (empty($id)) {
    echo json_encode(["status" => "error", "message" => "Dato ID es requerido"]);
    exit;
}

try {
    $html = '';
    
    // Fetch data
    $response = $controller->getById($id);
    if ($response['status'] === 'success') {
        $solicitud = $response['data'];
        
        $titulo = htmlspecialchars($solicitud['tis_titulo'] ?? 'Sin Título');
        $id_publica = htmlspecialchars($solicitud['rgt_id_publica'] ?? '-');
        $fecha_ingreso = isset($solicitud['tis_creacion']) ? $fechaHelper->formatearFecha($solicitud['tis_creacion']) : '-';
        $tipo_doc = htmlspecialchars($solicitud['tipo_nombre'] ?? 'Ingreso General');
        $remitente = htmlspecialchars(($solicitud['resp_nombre'] ?? '') . ' ' . ($solicitud['resp_apellido'] ?? ''));
        $plazo_respuesta = isset($solicitud['tis_fecha_limite']) ? $fechaHelper->formatearFecha($solicitud['tis_fecha_limite']) : 'Sin plazo';
        $estado = htmlspecialchars($solicitud['tis_estado'] ?? 'PENDIENTE');
        $contenido = nl2br(htmlspecialchars($solicitud['tis_contenido'] ?? ''));

        // HTML Base
        $html = '
        <style>
            .header-table { width: 100%; border-bottom: 2px solid #346d77; margin-bottom: 20px; padding-bottom: 10px; }
            .header-title { font-size: 18px; font-weight: bold; color: #333; }
            .header-subtitle { font-size: 10px; color: #346d77; font-weight: bold; text-transform: uppercase; }
            .section-title { font-size: 14px; font-weight: bold; color: #333; margin-top: 20px; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px solid #eee; }
            .data-table { width: 100%; margin-bottom: 20px; }
            .label { font-size: 9px; color: #94a3b8; font-weight: bold; text-transform: uppercase; }
            .value { font-size: 11px; font-weight: bold; color: #1e293b; }
            .value-red { color: #e74c3c; }
            .content-box { background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; font-size: 10px; line-height: 1.6; color: #334155; }
            .flow-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .flow-header { background-color: #346d77; color: white; font-weight: bold; font-size: 10px; }
            .flow-row { border-bottom: 1px solid #f1f5f9; }
            .flow-cell { padding: 8px; font-size: 9px; }
            .badge { padding: 4px 8px; border-radius: 4px; font-size: 9px; font-weight: bold; text-transform: uppercase; color: white; }
            .badge-teal { background-color: #16a085; }
            .attachment-item { font-size: 9px; color: #475569; padding: 3px 0; border-bottom: 1px solid #f1f5f9; }
        </style>

        <table class="header-table">
            <tr>
                <td width="70%">
                    <span class="header-subtitle">Gestión Documental Digital</span><br>
                    <span class="header-title">SOLICITUD DE INGRESO Nº ' . $id_publica . '</span>
                </td>
                <td width="30%" align="right">
                    <span class="badge badge-teal">' . $estado . '</span>
                </td>
            </tr>
        </table>

        <div class="section-title">Antecedentes del Ingreso</div>
        <table class="data-table">
            <tr>
                <td width="70%" colspan="2">
                    <span class="label">Título / Referencia</span><br>
                    <span class="value">' . $titulo . '</span>
                </td>
                <td width="30%" align="right">
                    <span class="label">Fecha Ingreso</span><br>
                    <span class="value">' . $fecha_ingreso . '</span>
                </td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
                <td width="35%">
                    <span class="label">Tipo de Documento</span><br>
                    <span class="value">' . $tipo_doc . '</span>
                </td>
                <td width="35%">
                    <span class="label">Remitente</span><br>
                    <span class="value">' . $remitente . '</span>
                </td>
                <td width="30%" align="right">
                    <span class="label" style="color:#e74c3c">Plazo Respuesta</span><br>
                    <span class="value value-red">' . $plazo_respuesta . '</span>
                </td>
            </tr>
        </table>

        <div class="section-title">Contenido / Providencia</div>
        <div class="content-box">' . $contenido . '</div>

        <div class="section-title">Flujo de Visación</div>
        <table class="flow-table">
            <thead>
                <tr class="flow-header">
                    <th class="flow-cell" width="40%">Funcionario</th>
                    <th class="flow-cell" width="30%">Rol / Facultad</th>
                    <th class="flow-cell" width="30%">Estado</th>
                </tr>
            </thead>
            <tbody>';

        if (!empty($solicitud['destinos'])) {
            foreach ($solicitud['destinos'] as $d) {
                $nombre = htmlspecialchars($d['usr_nombre'] . ' ' . $d['usr_apellido']);
                $facultad = htmlspecialchars($d['tid_facultad']);
                $lblEstado = ($d['tid_facultad'] === "Visador") ? 'Visado' : 'Respondido';
                $statusStr = 'Pendiente';
                
                if ($d['tid_responde'] == 1) {
                    $statusStr = $lblEstado . ' el ' . ($d['tid_fecha_respuesta'] ? $fechaHelper->formatearFecha($d['tid_fecha_respuesta']) : '');
                } elseif (($d['tid_responde'] == 0 || $d['tid_responde'] === '0') && !empty($d['tid_fecha_respuesta'])) {
                    $statusStr = 'Rechazado el ' . $fechaHelper->formatearFecha($d['tid_fecha_respuesta']);
                }
                
                $html .= '<tr class="flow-row">
                    <td class="flow-cell">' . $nombre . '</td>
                    <td class="flow-cell">' . $facultad . '</td>
                    <td class="flow-cell">' . $statusStr . '</td>
                </tr>';
            }
        } else {
            $html .= '<tr><td colspan="3" class="flow-cell" align="center">Sin flujo de visación definido</td></tr>';
        }

        $html .= '</tbody></table>';

        if (!empty($solicitud['documentos'])) {
            $html .= '<div class="section-title">Adjuntos y Referencias</div>';
            foreach ($solicitud['documentos'] as $doc) {
                $html .= '<div class="attachment-item">• ' . htmlspecialchars($doc['doc_nombre_documento'] ?? 'Archivo') . '</div>';
            }
        }
    } else {
        $html = '<h1>Error</h1><p>Solicitud #' . htmlspecialchars($id) . ' no encontrada o no autorizada.</p>';
    }

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sistema de Transformación Digital');
    $pdf->SetTitle('Expediente de Ingreso');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdfContent = $pdf->Output('Expediente.pdf', 'I');
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando PDF: " . $e->getMessage()]);
}
