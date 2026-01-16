<?php
// 1. Desactiva la visualización de errores para que no ensucien el archivo binario
ini_set('display_errors', 0);
error_reporting(E_ALL);

$DB_HOST = 'localhost';
$DB_NAME = 'transformacion_digital';
$DB_USER = 'root';
$DB_PASS = 'root';

$cn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$cn) {
    http_response_code(500);
    exit; // No imprimas nada aquí si es para descarga
}

$doc_id = $_GET['archivo'] ?? null;

if (!$doc_id || !ctype_digit((string) $doc_id)) {
    http_response_code(400);
    exit('ID inválido');
}

// Usamos mysqli_real_escape_string por seguridad básica
$id_safe = mysqli_real_escape_string($cn, $doc_id);

$sql = "SELECT doc_enlace_documento, doc_nombre_documento 
        FROM trd_general_documento_adjunto 
        WHERE doc_id = $id_safe 
        LIMIT 1";

$query = mysqli_query($cn, $sql);
$doc = mysqli_fetch_array($query);

if (!$doc) {
    http_response_code(404);
    exit('Documento no encontrado en BD');
}

// ELIMINADO: Ya no usamos echo $sql, echo $ruta, etc.

$ruta_relativa = $doc['doc_enlace_documento'];
$nombre = $doc['doc_nombre_documento'] ?: basename($ruta_relativa);

// Ajuste de ruta: Asegúrate que esta ruta sea la correcta físicamente
$ruta_final = ".." . $ruta_relativa;

if (!is_file($ruta_final)) {
    http_response_code(404);
    exit('El archivo físico no existe');
}

// 2. LIMPIEZA TOTAL DEL BÚFER
// Esto elimina cualquier espacio en blanco o eco previo accidental
while (ob_get_level()) {
    ob_end_clean();
}

// 3. ENCABEZADOS DE DESCARGA
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); // Fuerza descarga
header('Content-Disposition: attachment; filename="' . basename($nombre) . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($ruta_final));
header('X-Content-Type-Options: nosniff');

// 4. ENVÍO DEL ARCHIVO
flush();
readfile($ruta_final);
exit;