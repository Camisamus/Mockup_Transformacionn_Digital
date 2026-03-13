<?php
require_once __DIR__ . '/../api/Config/Database.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$query = "SELECT oia_id, oia_solicitud, oia_asignador, oia_asignacion FROM trd_oirs_asignaciones WHERE oia_solicitud = 9";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "--- ASIGNACIONES ---\n";
print_r($rows);

$query2 = "SELECT usr_id, usr_nombre, usr_apellido FROM trd_acceso_usuarios WHERE usr_nombre LIKE '%LETICIA%' OR usr_nombre LIKE '%RAMON%'";
$stmt2 = $db->prepare($query2);
$stmt2->execute();
$users = $stmt2->fetchAll(PDO::FETCH_ASSOC);

echo "\n--- USERS ---\n";
print_r($users);
