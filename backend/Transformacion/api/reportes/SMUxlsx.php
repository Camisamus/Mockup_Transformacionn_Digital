<?php

require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

echo "hola";
exit;

$accion = $data['REPORTE'] ?? $_POST['REPORTE'] ?? '';
print_r($accion);
exit;




use App\Config\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$database = new Database();
$db = $database->getConnection();

if (empty($accion)) {
    echo json_encode(["status" => "error", "message" => "Dato REPORTE es requerido para el Excel"]);
    exit;
}

try {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte');
    switch ($accion) {
        case 'TEST_XLSX':
            break;
        case 'SMU_desve_03E8':
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Nombre');
            $sheet->setCellValue('C1', 'Descripción');
            $sheet->setCellValue('A2', 1);
            $sheet->setCellValue('B2', 'Prueba Excel');
            $sheet->setCellValue('C2', 'Generación de Excel de prueba mediante PhpSpreadsheet');
            break;

        default:
            $sheet->setCellValue('A1', 'Reporte no definido');
            $sheet->setCellValue('A2', 'El reporte solicitado (' . $accion . ') no tiene un template asignado.');
            break;
    }

    $writer = new Xlsx($spreadsheet);

    // Obtenemos el output en un buffer
    ob_start();
    $writer->save('php://output');
    $excelContent = ob_get_clean();

    // Convertimos a hexadecimal
    $hexOutput = bin2hex($excelContent);

    // Retornamos el string hexadecimal
    echo $hexOutput;
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando Excel: " . $e->getMessage()]);
}
/*
cambio de planes, no trabajaremos los reportes como una api unica.
vamos a crear un php para cada reporte que vayamos a generar.
empezaremos por uno llamado 
Historial DESVE
tendra los siguientes campos 

ID	
CODIGO DESVE	
Nombre del expediente	
ORGANIZACIÓN (TIPO DE ORGANIZACION)	
Origen de solicitud	
Fecha DE CREACION	
Prioridad	
Funcionario Interno	(DESTINO)
Sector	
FECHA DEL ULTIMO Mail enviado 
A QUIEN SE LE ENVIO DICHO mail
ESTADO DE ENTREGA	
Fecha  DE ENTREGA 
dias Transcurridos	
OBSERVACIONES	
Fecha limite de entrega	
Dias Restantes

Y TENDRA LOS FILTROS 
ESTADO?
FECHAS? (INICIO Y FIN)
SON O NO REINGRESOS?
fUNCIONARIO ASIGNADO

ESTOS FILTROS SE LE ENVIARAN A EL PHP POR JSON y si no vienen definidos no aplicara ese filtro la consulta
*/