<?php
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
require_once __DIR__ . '/backend/Transformacion/src/Models/gesdoc_documentos_carpeta.php';

use App\Config\Database;
use App\Models\gesdoc_documentos_carpeta;

$db = (new Database())->getConnection();
$gesdoc = new gesdoc_documentos_carpeta($db);

$testIds = [1, 2, 3, 4, 5, 6, 7]; // IDs numéricos que vimos en el log anterior

foreach ($testIds as $id) {
    echo "Probando ID: $id\n";
    $version = $gesdoc->getLatestDocumentoVersion($id);
    if ($version) {
        echo "  EXITO: Encontrada versión {$version['docv_id']} - Archivo: {$version['doc_nombre_documento']}\n";
    } else {
        echo "  FALLO: No se encontró versión para ID: $id\n";
    }
}
