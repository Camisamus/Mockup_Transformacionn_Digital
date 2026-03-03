<?php
require 'apivec/general/app_autoload.php';
require 'vendor/autoload.php';
use App\Config\Database;
$db = (new Database())->getConnection();
$stmt = $db->query('DESCRIBE trd_acceso_vecinos');
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>