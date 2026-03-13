<?php
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
use App\Config\Database;

$db = (new Database())->getConnection();

echo "--- VALIDACIÓN CRUZADA ---\n";
$sql = "SELECT d.dee_id, d.dee_nombre, d.dee_documento, 
               (SELECT COUNT(*) FROM trd_general_documento_adjunto WHERE doc_id = d.dee_documento) as existe_adjunto,
               (SELECT COUNT(*) FROM trd_general_documento_adjunto_versiones WHERE docv_doc_id = d.dee_documento) as existe_version
        FROM trd_desecon_docentregada d
        ORDER BY d.dee_id DESC LIMIT 20";
$stmt = $db->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $row) {
    echo "ID: {$row['dee_id']} | Nombre: {$row['dee_nombre']} | DocID: {$row['dee_documento']} | Existe Adjunto: {$row['existe_adjunto']} | Existe Version: {$row['existe_version']}\n";
}

echo "\n--- ÚLTIMAS VERSIONES EN GESDOC ---\n";
$stmt = $db->query("SELECT docv_id, docv_doc_id, doc_nombre_documento FROM trd_general_documento_adjunto_versiones ORDER BY docv_id DESC LIMIT 10");
$versiones = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($versiones as $v) {
    echo "vID: {$row['docv_id']} | docID: {$v['docv_doc_id']} | Nombre: {$v['doc_nombre_documento']}\n";
}
