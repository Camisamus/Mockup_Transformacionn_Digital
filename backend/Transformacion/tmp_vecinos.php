<?php
require 'apivec/general/app_autoload.php';
require 'vendor/autoload.php';
use App\Config\Database;
$db = (new Database())->getConnection();
$stmt = $db->query('SELECT vec_email FROM trd_acceso_vecinos LIMIT 5');
echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
?>