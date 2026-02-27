<?php
require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

use App\Config\Database;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

$database = new Database();
$db = $database->getConnection();

$accion = $data['REPORTE'] ?? $_POST['REPORTE'] ?? '';

if (empty($accion)) {
    echo json_encode(["status" => "error", "message" => "Dato REPORTE es requerido para el Word"]);
    exit;
}

try {
    $phpWord = new PhpWord();

    // Set document properties
    $properties = $phpWord->getDocInfo();
    $properties->setCreator('Sistema de Gestión');
    $properties->setCompany('SMU');
    $properties->setTitle('Reporte');
    $properties->setDescription('Generado automáticamente');
    $properties->setCategory('Reportes');
    $properties->setLastModifiedBy('Sistema');

    switch ($accion) {
        case 'TEST_DOCX':
            // Adding an empty Section to the document
            $section = $phpWord->addSection();

            // Adding Text element to the Section
            $section->addText(
                'Reporte de Prueba',
                array('name' => 'Arial', 'size' => 16, 'bold' => true)
            );
            $section->addTextBreak(1);
            $section->addText('Este es un documento Word de prueba generado para validar la implementación de PhpWord con salida hexadecimal.');
            break;

        default:
            $section = $phpWord->addSection();
            $section->addText(
                'Reporte no definido',
                array('name' => 'Arial', 'size' => 16, 'bold' => true, 'color' => 'FF0000')
            );
            $section->addTextBreak(1);
            $section->addText('El reporte solicitado (' . htmlspecialchars($accion) . ') no tiene un template asignado.');
            break;
    }

    // Save the document to string using output buffering
    ob_start();
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
    $wordContent = ob_get_clean();

    // Convert to hexadecimal as requested
    $hexOutput = bin2hex($wordContent);

    // Return the hex string
    echo $hexOutput;
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando Word: " . $e->getMessage()]);
}
