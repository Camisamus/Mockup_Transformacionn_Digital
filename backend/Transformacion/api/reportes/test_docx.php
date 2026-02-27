<?php
// Test script for SMUdocx.php
$url = 'http://127.0.0.1/Transformacion/api/reportes/SMUdocx.php';
$data = ['REPORTE' => 'TEST_DOCX', 'ACCION' => 'GENERAR'];

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
    echo "Error calling SMUdocx.php\n";
    exit;
}

if (ctype_xdigit($result)) {
    echo "SUCCESS: The response is a valid hexadecimal string.\n";
    echo "Length: " . strlen($result) . " hex characters.\n";

    // Convert back to binary to check if it's a ZIP/DOCX file
    $binary = hex2bin($result);
    // DOCX files are ZIP archives, they should start with "PK"
    if (strpos($binary, 'PK') === 0) {
        echo "SUCCESS: The decoded content starts with PK header (valid ZIP/DOCX).\n";
    } else {
        echo "FAILURE: The decoded content does NOT start with PK header.\n";
    }
} else {
    echo "FAILURE: The response is NOT a hexadecimal string.\n";
    echo "Response preview: " . substr($result, 0, 100) . "...\n";
}
