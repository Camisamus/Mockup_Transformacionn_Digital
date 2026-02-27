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

// ── Filtros opcionales (llegan por JSON, si no vienen no se aplican) ──
$filtro_estado = $data['ESTADO'] ?? null;           // 0 = Pendiente, 1 = Entregado, '' = Todos
$filtro_fecha_inicio = $data['FECHA_INICIO'] ?? null;     // 'YYYY-MM-DD'
$filtro_fecha_fin = $data['FECHA_FIN'] ?? null;        // 'YYYY-MM-DD'
$filtro_reingresos = $data['REINGRESOS'] ?? null;       // 'SI', 'NO', null = todos
$filtro_funcionario = $data['FUNCIONARIO_ID'] ?? null;   // ID del funcionario asignado

// ── Construcción dinámica de la consulta SQL ──
$where = ["tds.sol_borrado = 0"];
$params = [];

// Filtro de estado
if ($filtro_estado !== null && $filtro_estado !== '') {
    $where[] = "tds.sol_estado_entrega = :estado";
    $params[':estado'] = (int) $filtro_estado;
}

// Filtro de fechas (por fecha de creación/recepción)
if ($filtro_fecha_inicio) {
    $where[] = "DATE(tds.sol_fecha_recepcion) >= :fecha_inicio";
    $params[':fecha_inicio'] = $filtro_fecha_inicio;
}
if ($filtro_fecha_fin) {
    $where[] = "DATE(tds.sol_fecha_recepcion) <= :fecha_fin";
    $params[':fecha_fin'] = $filtro_fecha_fin;
}

// Filtro de reingresos
if ($filtro_reingresos === 'SI') {
    $where[] = "tds.sol_reingreso_id IS NOT NULL";
} elseif ($filtro_reingresos === 'NO') {
    $where[] = "tds.sol_reingreso_id IS NULL";
}

// Filtro de funcionario asignado (destino)
if ($filtro_funcionario) {
    $where[] = "tdd.tid_destino = :funcionario_id";
    $params[':funcionario_id'] = (int) $filtro_funcionario;
}

$whereClause = implode(' AND ', $where);

$query = "SELECT DISTINCT
    tds.sol_id,
    tds.sol_ingreso_desve,
    tds.sol_nombre_expediente,
    -- Organización y tipo
    org.org_nombre AS organizacion_nombre,
    tor.tor_nombre AS tipo_organizacion,
    tds.sol_origen_texto,
    tds.sol_origen_esp,
    -- Fechas
    tds.sol_fecha_recepcion,
    tds.sol_fecha_vencimiento,
    tds.sol_fecha_respuesta_coordinador,
    -- Prioridad
    pri.pri_nombre AS prioridad_nombre,
    -- Funcionario destino (interno)
    GROUP_CONCAT(DISTINCT UPPER(CONCAT(usu_dest.usr_nombre, ' ', usu_dest.usr_apellido)) SEPARATOR ', ') AS funcionarios_destino,
    -- Sector
    sec.sec_nombre AS sector_nombre,
    -- Último mail
    -- Estado
    tds.sol_estado_entrega,
    tds.sol_entrego_coordinador,
    -- Días
    tds.sol_dias_transcurridos,
    tds.sol_dias_vencimiento,
    -- Observaciones
    tds.sol_observaciones,
    -- Reingreso
    tds.sol_reingreso_id
FROM trd_desve_solicitudes tds
LEFT JOIN trd_desve_destinos tdd ON tds.sol_id = tdd.tid_desve_solicitud AND tdd.tid_borrado = 0
LEFT JOIN trd_acceso_usuarios usu_dest ON tdd.tid_destino = usu_dest.usr_id
LEFT JOIN trd_desve_organizaciones org ON tds.sol_origen_id = org.org_id
LEFT JOIN trd_general_tipos_organizacion tor ON org.org_tipo_id = tor.tor_id
LEFT JOIN trd_desve_prioridades pri ON tds.sol_prioridad_id = pri.pri_id
LEFT JOIN trd_general_sectores sec ON tds.sol_sector_id = sec.sec_id
WHERE {$whereClause}
GROUP BY tds.sol_id
ORDER BY tds.sol_id DESC";

try {
    $stmt = $db->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    // ── Obtener últimas 3 fechas de emails por solicitud ──
    $emailsPorSolicitud = [];
    if (!empty($rows)) {
        // Recopilar todos los sol_id para buscar sus expedientes
        $solIds = array_column($rows, 'sol_id');
        $placeholders = implode(',', array_fill(0, count($solIds), '?'));

        $queryEmails = "SELECT 
                tds_sub.sol_id,
                gme.gme_creacion AS fecha_email,
                CASE 
                    WHEN gme.gme_destinatario_funcionario IS NOT NULL 
                        THEN UPPER(CONCAT(u.usr_nombre, ' ', u.usr_apellido))
                    WHEN c.tgc_tipo = 'juridica' 
                        THEN UPPER(c.tgc_razon_social)
                    ELSE UPPER(CONCAT(c.tgc_nombre, ' ', IFNULL(c.tgc_apellido_paterno, '')))
                END AS destinatario_nombre,
                JSON_EXTRACT(gme.gme_contenido, '$.email') AS destinatario_email
            FROM trd_general_mails_enviados gme
            INNER JOIN trd_desve_solicitudes tds_sub ON tds_sub.sol_registro_tramite = gme.gme_expediente
            LEFT JOIN trd_acceso_usuarios u ON gme.gme_destinatario_funcionario = u.usr_id
            LEFT JOIN trd_general_contribuyentes c ON gme.gme_destinatario_no_funcionario = c.tgc_id
            WHERE tds_sub.sol_id IN ($placeholders)
              AND (gme.gme_borado = 0 OR gme.gme_borado IS NULL)
            ORDER BY tds_sub.sol_id, gme.gme_creacion DESC";

        $stmtEmails = $db->prepare($queryEmails);
        $stmtEmails->execute($solIds);
        $allEmails = $stmtEmails->fetchAll(\PDO::FETCH_ASSOC);

        // Agrupar por sol_id y limitar a 3 por solicitud
        foreach ($allEmails as $em) {
            $sid = $em['sol_id'];
            if (!isset($emailsPorSolicitud[$sid])) {
                $emailsPorSolicitud[$sid] = [];
            }
            if (count($emailsPorSolicitud[$sid]) < 3) {
                $emailsPorSolicitud[$sid][] = $em;
            }
        }
    }

    // ── Generar Excel con PhpSpreadsheet ──
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Historial DESVE');

    // Encabezados
    $headers = [
        'A' => 'ID',
        'B' => 'CÓDIGO DESVE',
        'C' => 'NOMBRE DEL EXPEDIENTE',
        'D' => 'ORGANIZACIÓN (TIPO)',
        'E' => 'ORIGEN DE SOLICITUD',
        'F' => 'FECHA DE CREACIÓN',
        'G' => 'PRIORIDAD',
        'H' => 'FUNCIONARIO INTERNO (DESTINO)',
        'I' => 'SECTOR',
        'J' => 'FECHA ÚLTIMO MAIL ENVIADO',
        'K' => 'A QUIÉN SE ENVIÓ EL MAIL',
        'L' => 'ESTADO DE ENTREGA',
        'M' => 'FECHA DE ENTREGA',
        'N' => 'DÍAS TRANSCURRIDOS',
        'O' => 'OBSERVACIONES',
        'P' => 'FECHA LÍMITE DE ENTREGA',
        'Q' => 'DÍAS RESTANTES'
    ];

    foreach ($headers as $col => $title) {
        $sheet->setCellValue($col . '1', $title);
    }

    // Estilos del encabezado
    $headerRange = 'A1:Q1';
    $sheet->getStyle($headerRange)->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
            'size' => 10,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '2C3E50'],
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
    $sheet->getRowDimension(1)->setRowHeight(30);

    // Datos
    $rowNum = 2;
    foreach ($rows as $row) {
        // Determinar origen de solicitud
        $origen = '';
        if ($row['sol_origen_esp'] == 1) {
            $origen = $row['organizacion_nombre'] ?? 'N/A';
        } elseif ($row['sol_origen_esp'] == 2) {
            $origen = $row['sol_origen_texto'] ?? 'N/A';
        } else {
            $origen = $row['sol_origen_texto'] ?? ($row['organizacion_nombre'] ?? 'N/A');
        }

        // Organización con tipo
        $orgConTipo = ($row['organizacion_nombre'] ?? 'N/A');
        if (!empty($row['tipo_organizacion'])) {
            $orgConTipo .= ' (' . $row['tipo_organizacion'] . ')';
        }

        // Estado de entrega
        $estadoEntrega = ($row['sol_estado_entrega'] == 1) ? 'Entregado' : 'Pendiente';

        // Fecha de entrega (fecha respuesta coordinador)
        $fechaEntrega = $row['sol_fecha_respuesta_coordinador'] ?? '';

        // Calcular días restantes
        $diasRestantes = '';
        if (!empty($row['sol_fecha_vencimiento'])) {
            $hoy = new \DateTime();
            $vencimiento = new \DateTime($row['sol_fecha_vencimiento']);
            $diff = $hoy->diff($vencimiento);
            $diasRestantes = $diff->invert ? -$diff->days : $diff->days;
        }

        $sheet->setCellValue('A' . $rowNum, $row['sol_id']);
        $sheet->setCellValue('B' . $rowNum, $row['sol_ingreso_desve'] ?? '');
        $sheet->setCellValue('C' . $rowNum, $row['sol_nombre_expediente'] ?? '');
        $sheet->setCellValue('D' . $rowNum, $row['tipo_organizacion']);
        $sheet->setCellValue('E' . $rowNum, $row['organizacion_nombre']);
        $sheet->setCellValue('F' . $rowNum, $row['sol_fecha_recepcion'] ?? '');
        $sheet->setCellValue('G' . $rowNum, $row['prioridad_nombre'] ?? 'N/A');
        //$sheet->setCellValue('H' . $rowNum, $row['funcionarios_destino'] ?? 'N/A');
        $sheet->setCellValue('H' . $rowNum, $row['funcionarios_destino'] ?? 'N/A');
        $sheet->setCellValue('I' . $rowNum, $row['sector_nombre'] ?? 'N/A');
        // Últimas 3 fechas de emails y destinatarios
        $emailsSol = $emailsPorSolicitud[$row['sol_id']] ?? [];
        $fechasEmail = [];
        $destEmail = [];
        foreach ($emailsSol as $em) {
            $fechasEmail[] = $em['fecha_email'] ?? '';
            $nombre = $em['destinatario_nombre'] ?? '';
            $email = trim($em['destinatario_email'] ?? '', '"');
            $destEmail[] = $nombre ? "$nombre ($email)" : $email;
        }
        $sheet->setCellValue('J' . $rowNum, implode("\n", $fechasEmail));
        $sheet->setCellValue('K' . $rowNum, implode("\n", $destEmail));
        $sheet->setCellValue('L' . $rowNum, $estadoEntrega);
        $sheet->setCellValue('M' . $rowNum, $fechaEntrega);
        $sheet->setCellValue('N' . $rowNum, $row['sol_dias_transcurridos'] ?? 0);
        $sheet->setCellValue('O' . $rowNum, $row['sol_observaciones'] ?? '');
        $sheet->setCellValue('P' . $rowNum, $row['sol_fecha_vencimiento'] ?? '');
        $sheet->setCellValue('Q' . $rowNum, $diasRestantes);

        $rowNum++;
    }

    // Estilos de datos
    if ($rowNum > 2) {
        $dataRange = 'A2:Q' . ($rowNum - 1);
        $sheet->getStyle($dataRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);
    }

    // Autosize columnas
    foreach (range('A', 'Q') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Generar output
    $writer = new Xlsx($spreadsheet);
    ob_start();
    $writer->save('php://output');
    $excelContent = ob_get_clean();

    // Retornar como hex (patrón existente del proyecto)
    echo bin2hex($excelContent);
    exit;

} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error generando Excel: " . $e->getMessage()]);
}
