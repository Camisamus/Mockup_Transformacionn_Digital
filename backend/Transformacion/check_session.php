<?php
require 'api/general/session_start.php';
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    $userId = $_SESSION['user_id'] ?? 1;
    echo "Usuario ID: $userId\n";
    
    $query = "SELECT up.*, r.prf_nombre 
              FROM trd_acceso_rol_usuario up
              JOIN trd_acceso_roles r ON up.usp_rol_id = r.prf_id
              WHERE up.usp_usuario_id = :userId AND up.usp_borrado = 0";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Roles del usuario:\n";
    print_r($roles);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
