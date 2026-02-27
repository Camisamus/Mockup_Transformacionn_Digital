<?php
// Test script for SMUxlsx.php
$url = 'http://127.0.0.1/Transformacion/api/reportes/SMUxlsx.php';
$data = ['REPORTE' => 'TEST_XLSX', 'ACCION' => 'GENERAR'];

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo "Error calling SMUxlsx.php\n";
    exit;
}

if (ctype_xdigit($result)) {
    echo "SUCCESS: The response is a valid hexadecimal string.\n";
    echo "Length: " . strlen($result) . " hex characters.\n";

    // Convert back to binary to check if it's a ZIP/XLSX file
    $binary = hex2bin($result);
    // XLSX files are ZIP archives, they should start with "PK"
    if (strpos($binary, 'PK') === 0) {
        echo "SUCCESS: The decoded content starts with PK header (valid ZIP/XLSX).\n";
    } else {
        echo "FAILURE: The decoded content does NOT start with PK header.\n";
    }
} else {
    echo "FAILURE: The response is NOT a hexadecimal string.\n";
    echo "Response preview: " . substr($result, 0, 100) . "...\n";
}
