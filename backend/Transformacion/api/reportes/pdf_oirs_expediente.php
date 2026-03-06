<?php
require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

use App\Config\Database;
// Asumo que tienes un controlador para OIRS similar al de Ingresos
use App\Controllers\OirsControler; 
use App\Helpers\Encode;
use App\Helpers\Fechas;

// 1. Inicializar conexión y herramientas
$database = new Database();
$db = $database->getConnection();

$controller = new OirsControler($db);
$encoder = new Encode();
$fechaHelper = new Fechas();

// 2. Obtener el ID (Folio o ID interno) desde la petición
$id = $data['ID'] ?? $_GET['ID'] ?? null;

// Descifrar si viene codificado
if ($id && is_string($id) && strpos($id, 'L$U') === 0) {
    $id = $encoder->descifrar($id);
}

if (empty($id)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "El ID de la solicitud es requerido"]);
    exit;
}

try {
    // 3. Obtener los datos de la OIRS desde la base de datos
    $response = $controller->getById($id);
    
    if ($response['status'] !== 'success') {
        throw new Exception("Solicitud OIRS no encontrada.");
    }

    $oirs = $response['data'];

    // 4. Mapeo de variables (Ajusta los nombres según tu BD)
    $folio = htmlspecialchars($oirs['oirs_folio'] ?? 'S/F');
    $fecha_reg = isset($oirs['oirs_fecha_reg']) ? $fechaHelper->formatearFecha($oirs['oirs_fecha_reg']) : date('d/m/Y');
    $hora_reg = htmlspecialchars($oirs['oirs_hora_reg'] ?? '--:--');
    
    // Datos Contribuyente
    $nombre_completo = htmlspecialchars(($oirs['cont_nombre'] ?? '') . ' ' . ($oirs['cont_apellido_p'] ?? '') . ' ' . ($oirs['cont_apellido_m'] ?? ''));
    $rut = htmlspecialchars($oirs['cont_rut'] ?? 'No registrado');
    $email = htmlspecialchars($oirs['cont_email'] ?? 'No registrado');
    $telefono = htmlspecialchars($oirs['cont_telefono'] ?? 'No registrado');
    
    // Detalles Solicitud
    $tematica = htmlspecialchars($oirs['tematica_nombre'] ?? 'General');
    $subtematica = htmlspecialchars($oirs['subtematica_nombre'] ?? 'Sin especificar');
    $sector = htmlspecialchars($oirs['sector_nombre'] ?? 'Toda la comuna');
    $descripcion = nl2br(htmlspecialchars($oirs['oirs_descripcion'] ?? 'Sin descripción'));
    $respuesta = nl2br(htmlspecialchars($oirs['oirs_respuesta_inmediata'] ?? 'Sin respuesta registrada en el acto.'));

    // 5. Construcción del HTML para el PDF
    $html = '
    <style>
        .header-table { width: 100%; border-bottom: 2px solid #1a5f9c; margin-bottom: 20px; padding-bottom: 10px; }
        .header-title { font-size: 16px; font-weight: bold; color: #1a5f9c; }
        .header-subtitle { font-size: 9px; color: #64748b; font-weight: bold; text-transform: uppercase; }
        .section-title { font-size: 12px; font-weight: bold; color: #334155; background-color: #f1f5f9; padding: 5px; margin-top: 15px; }
        .data-table { width: 100%; margin-top: 10px; }
        .label { font-size: 8px; color: #64748b; font-weight: bold; text-transform: uppercase; }
        .value { font-size: 10px; color: #1e293b; }
        .content-box { border: 1px solid #e2e8f0; padding: 10px; font-size: 10px; color: #334155; margin-top: 5px; background-color: #fafafa; }
        .footer { font-size: 8px; color: #94a3b8; text-align: center; margin-top: 30px; }
    </style>

    <table class="header-table">
        <tr>
            <td width="70%">
                <span class="header-subtitle">Municipio de Cuidados - Viña del Mar</span><br>
                <span class="header-title">COMPROBANTE DE SOLICITUD OIRS</span>
            </td>
            <td width="30%" align="right">
                <span class="label">Folio Sistema:</span><br>
                <span style="font-size: 14px; font-weight: bold; color: #ef4444;">' . $folio . '</span>
            </td>
        </tr>
    </table>

    <div class="section-title">1. IDENTIFICACIÓN DEL CONTRIBUYENTE</div>
    <table class="data-table" cellpadding="4">
        <tr>
            <td width="50%">
                <span class="label">Nombre Completo:</span><br>
                <span class="value">' . $nombre_completo . '</span>
            </td>
            <td width="50%">
                <span class="label">RUT:</span><br>
                <span class="value">' . $rut . '</span>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <span class="label">Correo Electrónico:</span><br>
                <span class="value">' . $email . '</span>
            </td>
            <td width="50%">
                <span class="label">Teléfono:</span><br>
                <span class="value">' . $telefono . '</span>
            </td>
        </tr>
    </table>

    <div class="section-title">2. DETALLES DE LA ATENCIÓN</div>
    <table class="data-table" cellpadding="4">
        <tr>
            <td width="33%">
                <span class="label">Fecha Registro:</span><br>
                <span class="value">' . $fecha_reg . '</span>
            </td>
            <td width="33%">
                <span class="label">Hora:</span><br>
                <span class="value">' . $hora_reg . '</span>
            </td>
            <td width="34%">
                <span class="label">Sector/Territorio:</span><br>
                <span class="value">' . $sector . '</span>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <span class="label">Temática:</span><br>
                <span class="value">' . $tematica . '</span>
            </td>
            <td width="50%">
                <span class="label">Subtemática:</span><br>
                <span class="value">' . $subtematica . '</span>
            </td>
        </tr>
    </table>

    <div class="section-title">3. DESCRIPCIÓN DE LA SOLICITUD</div>
    <div class="content-box">' . $descripcion . '</div>';

    if (!empty($oirs['oirs_respuesta_inmediata'])) {
        $html .= '
        <div class="section-title">4. RESPUESTA ENTREGADA EN EL ACTO</div>
        <div class="content-box" style="border-left: 3px solid #10b981;">' . $respuesta . '</div>';
    }

    $html .= '
    <div class="footer">
        <hr border="0" height="1" style="background-color: #f1f5f9;">
        Documento generado automáticamente por el Sistema de Transformación Digital - Ilustre Municipalidad de Viña del Mar.<br>
        Este comprobante certifica la recepción de su solicitud en nuestros registros.
    </div>';

    // 6. Generación del PDF con TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // Configuración del documento
    $pdf->SetCreator('Gestión Municipal');
    $pdf->SetAuthor('Municipio Viña del Mar');
    $pdf->SetTitle('Comprobante OIRS - ' . $folio);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(TRUE, 15);
    
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);
    
    // Escribir el HTML
    $pdf->writeHTML($html, true, false, true, false, '');

    // Salida del PDF (I = Inline / Abrir en navegador)
    $pdf->Output('Comprobante_OIRS_' . $folio . '.pdf', 'I');
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando PDF: " . $e->getMessage()]);
}