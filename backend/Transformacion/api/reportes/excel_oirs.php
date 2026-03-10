<?php
require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/Database.php';

use App\Config\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error de conexión a base de datos"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

// ── Filtros (JSON) ──
$filtro_estado = $data['estado'] ?? null;
$filtro_fecha = $data['fecha'] ?? null;
$filtro_sector = $data['sector'] ?? null;
$filtro_tematica = $data['tematica'] ?? null;
$filtro_subtematica = $data['subtematica'] ?? null;
$filtro_prioridad = $data['prioridad'] ?? null;
$filtro_search = $data['search'] ?? null;

// ── Consulta Base ──
$query = "SELECT o.*, r.*, t.tem_nombre, s.sub_nombre, 
          tgc.tgc_nombre, tgc.tgc_apellido_paterno, tgc.tgc_apellido_materno, tgc.tgc_rut,
          tgc.tgc_razon_social, tgc.tgc_tipo, tgc.tgc_correo_electronico, tgc.tgc_telefono_contacto,
          sec.sec_nombre as sector_nombre,
          tat.tat_nombre as tipo_atencion_nombre,
          con.con_nombre as condicion_nombre,
          oig.oig_respuesta_preliminar, oig.oig_respuesta_tecnica, oig.oig_notificacion_ejecucion,
          d.tcd_calle, d.tcd_numero
          FROM trd_oirs_solicitud o
          JOIN trd_general_registro_general_expedientes r ON o.oirs_registro_tramite = r.rgt_id
          LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
          LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
          LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
          LEFT JOIN trd_general_sectores sec ON o.oirs_sector = sec.sec_id
          LEFT JOIN trd_oirs_tipo_atencion tat ON o.oirs_tipo_atencion = tat.tat_id
          LEFT JOIN trd_oirs_condiciones con ON o.oirs_condicion = con.con_id
          LEFT JOIN trd_oirs_gestion oig ON o.oirs_id = oig.oig_solicitud
          LEFT JOIN trd_general_contribuyente_direcciones d ON tgc.tgc_id = d.tcd_contribuyente
          WHERE o.oirs_borrado = 0 AND r.rgt_borrado = 0";

$params = [];

if (isset($filtro_estado) && $filtro_estado !== '' && $filtro_estado !== null) {
    $query .= " AND o.oirs_estado = :estado";
    $params[':estado'] = $filtro_estado;
}
if (!empty($filtro_fecha)) {
    $query .= " AND DATE(o.oirs_creacion) = :fecha";
    $params[':fecha'] = $filtro_fecha;
}
if (!empty($filtro_sector)) {
    $query .= " AND o.oirs_sector = :sector";
    $params[':sector'] = $filtro_sector;
}
if (!empty($filtro_tematica)) {
    $query .= " AND o.oirs_tematica = :tematica";
    $params[':tematica'] = $filtro_tematica;
}
if (!empty($filtro_subtematica)) {
    $query .= " AND o.oirs_subtematica = :subtematica";
    $params[':subtematica'] = $filtro_subtematica;
}
if (!empty($filtro_prioridad)) {
    $query .= " AND o.oirs_prioridad_municipal = :prioridad";
    $params[':prioridad'] = $filtro_prioridad;
}
if (!empty($filtro_search)) {
    $query .= " AND (o.oirs_id LIKE :search1 OR tgc.tgc_rut LIKE :search2 OR tgc.tgc_nombre LIKE :search3 OR tgc.tgc_apellido_paterno LIKE :search4)";
    $searchWildcard = '%' . $filtro_search . '%';
    $params[':search1'] = $searchWildcard;
    $params[':search2'] = $searchWildcard;
    $params[':search3'] = $searchWildcard;
    $params[':search4'] = $searchWildcard;
}

$query .= " GROUP BY o.oirs_id ORDER BY o.oirs_id DESC"; // Agrupado por OIRS ID previniendo direcciones multiples

try {
    $stmt = $db->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ── Excel ──
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Resultados OIRS');

    $headers = [
        'A' => 'ID',
        'B' => 'TIPO DE ATENCIÓN',
        'C' => 'ORIGEN CONSULTA',
        'D' => 'CONDICIÓN',
        'E' => 'FECHA DE INGRESO',
        'F' => 'HORA DE INGRESO',
        'G' => 'TEMÁTICA PRINCIPAL',
        'H' => 'SUBTEMÁTICA',
        'I' => 'DIRECCIÓN DEL EVENTO',
        'J' => 'SECTOR',
        'K' => 'DESCRIPCIÓN DE LA SOLICITUD',
        'L' => 'RESPUESTA PRELIMINAR',
        'M' => 'RESPUESTA TÉCNICA',
        'N' => 'NOTIFICACIÓN DE EJECUCIÓN',
        'O' => 'RUT CONTRIBUYENTE',
        'P' => 'TIPO CONTRIBUYENTE',
        'Q' => 'NOMBRE',
        'R' => 'APELLIDO PATERNO',
        'S' => 'APELLIDO MATERNO',
        'T' => 'EMAIL',
        'U' => 'TELÉFONO',
        'V' => 'DIRECCIÓN PARTICULAR'
    ];

    foreach ($headers as $col => $title) {
        $sheet->setCellValue($col . '1', $title);
    }

    $headerRange = 'A1:V1';
    $sheet->getStyle($headerRange)->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
            'size' => 10,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '1a5f9c'], // primary-blue
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            'wrapText' => true,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ]);
    $sheet->getRowDimension(1)->setRowHeight(35);

    $rowNum = 2;
    foreach ($rows as $row) {
        $fechahora = $row['oirs_creacion'] ?? '';
        $solo_fecha = '';
        $solo_hora = '';
        if ($fechahora) {
            $solo_fecha = date('d-m-Y', strtotime($fechahora));
            $solo_hora = date('H:i:s', strtotime($fechahora));
        }

        $direccion_evento = trim(($row['oirs_calle'] ?? '') . ' ' . ($row['oirs_numero'] ?? ''));
        if (empty(trim($direccion_evento))) {
            $direccion_evento = $row['oirs_direccion_completa'] ?? '';
        }

        $direccion_particular = trim(($row['tcd_calle'] ?? '') . ' ' . ($row['tcd_numero'] ?? ''));

        $sheet->setCellValue('A' . $rowNum, $row['oirs_id'] ?? '');
        $sheet->setCellValue('B' . $rowNum, $row['tipo_atencion_nombre'] ?? 'N/A');
        $sheet->setCellValue('C' . $rowNum, $row['oirs_origen_consulta'] ?? 'N/A');
        $sheet->setCellValue('D' . $rowNum, $row['condicion_nombre'] ?? 'N/A');
        $sheet->setCellValue('E' . $rowNum, $solo_fecha);
        $sheet->setCellValue('F' . $rowNum, $solo_hora);
        $sheet->setCellValue('G' . $rowNum, $row['tem_nombre'] ?? 'Sin temática');
        $sheet->setCellValue('H' . $rowNum, $row['sub_nombre'] ?? 'General');
        $sheet->setCellValue('I' . $rowNum, $direccion_evento);
        $sheet->setCellValue('J' . $rowNum, $row['sector_nombre'] ?? 'N/A');
        $sheet->setCellValue('K' . $rowNum, $row['oirs_descripcion'] ?? '');
        $sheet->setCellValue('L' . $rowNum, strip_tags($row['oig_respuesta_preliminar'] ?? ''));
        $sheet->setCellValue('M' . $rowNum, strip_tags($row['oig_respuesta_tecnica'] ?? ''));
        $sheet->setCellValue('N' . $rowNum, strip_tags($row['oig_notificacion_ejecucion'] ?? ''));
        $sheet->setCellValue('O' . $rowNum, $row['tgc_rut'] ?? '');
        $sheet->setCellValue('P' . $rowNum, strtoupper($row['tgc_tipo'] ?? ''));
        $sheet->setCellValue('Q' . $rowNum, $row['tgc_nombre'] ?? ($row['tgc_tipo'] == 'juridica' ? $row['tgc_razon_social'] : ''));
        $sheet->setCellValue('R' . $rowNum, $row['tgc_apellido_paterno'] ?? '');
        $sheet->setCellValue('S' . $rowNum, $row['tgc_apellido_materno'] ?? '');
        $sheet->setCellValue('T' . $rowNum, $row['tgc_correo_electronico'] ?? '');
        $sheet->setCellValue('U' . $rowNum, $row['tgc_telefono_contacto'] ?? '');
        $sheet->setCellValue('V' . $rowNum, $direccion_particular);

        $rowNum++;
    }

    if ($rowNum > 2) {
        $dataRange = 'A2:V' . ($rowNum - 1);
        $sheet->getStyle($dataRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        // Ajustar ancho máximo de las columnas descriptivas para poder activarle wraptext (ej, descripcion)
        $sheet->getStyle('K2:N' . ($rowNum - 1))->getAlignment()->setWrapText(true);
        $sheet->getColumnDimension('K')->setWidth(45);
        $sheet->getColumnDimension('L')->setWidth(40);
        $sheet->getColumnDimension('M')->setWidth(40);
        $sheet->getColumnDimension('N')->setWidth(40);
        
    }

    foreach (range('A', 'J') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    foreach (range('O', 'V') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $writer = new Xlsx($spreadsheet);
    ob_start();
    $writer->save('php://output');
    $excelContent = ob_get_clean();

    echo bin2hex($excelContent);
    exit;

} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando Excel: " . $e->getMessage()]);
}
