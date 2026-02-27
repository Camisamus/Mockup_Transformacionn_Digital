<?php
require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

use App\Config\Database;

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Get the report type from the request
$reporte = $data['REPORTE'] ?? $_POST['REPORTE'] ?? '';

if (empty($reporte)) {
    echo json_encode(["status" => "error", "message" => "Dato REPORTE es requerido"]);
    exit;
}

try {
    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sistema de Gestión');
    $pdf->SetTitle('Reporte PDF');
    $pdf->SetSubject('Reporte Generado');

    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Content based on the requested report
    $html = '';
    switch ($reporte) {
        case 'TEST_PDF':
            $html = '<h1>Reporte de Prueba</h1><p>Este es un PDF de prueba generado para validar la implementación de TCPDF.</p>';
            break;

        case 'SMU_desve_03E8':
            break;
        // Add more cases here for specific reports

        default:
            $html = '<h1>Reporte no definido</h1><p>El reporte solicitado (' . htmlspecialchars($reporte) . ') no tiene un template asignado.</p>';
            break;
    }

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document to a string
    $pdfContent = $pdf->Output('reporte.pdf', 'S');

    // Convert to hexadecimal as requested
    $hexOutput = bin2hex($pdfContent);

    // Return the hex string
    echo $hexOutput;
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando PDF: " . $e->getMessage()]);
}
