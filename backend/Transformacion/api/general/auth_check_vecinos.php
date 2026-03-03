<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

require_once __DIR__ . '/session_start.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/app_autoload.php';

use App\Config\Database;
use App\Controllers\VecinosAuthController;

$database = new Database();
$db = $database->getConnection();
$auth = new VecinosAuthController($db);

$currentScriptPath = $_SERVER['SCRIPT_NAME'];
$pathPrefix = './';

// Lógica de prefijo similar a auth_check.php para mantener consistencia
if (stripos($currentScriptPath, '/vecinos/') !== false) {
    $afterVecinos = substr($currentScriptPath, stripos($currentScriptPath, '/vecinos/') + strlen('/vecinos/'));
    $subDirs = explode('/', $afterVecinos);
    $depth = count($subDirs);
    $pathPrefix = str_repeat('../', $depth);
}

// Verificar Autenticación de Vecino
if (!$auth->isAuthenticated()) {
    // Redirigir al login de vecinos (asumiendo que está en la raíz o carpeta designada)
    // Por ahora redirigimos al index.php de la raíz o donde el usuario especifique el login de vecinos
    $target = $pathPrefix . 'index.php';
    if (basename($currentScriptPath) !== 'index.php' || stripos($currentScriptPath, '/vecinos/') !== false) {
        header("Location: $target");
        exit;
    }
}

// Datos para el renderizado
$userData = [
    'nombre' => $_SESSION['vecino_nombre'] ?? '',
    'apellido' => $_SESSION['vecino_apellido'] ?? '',
    'email' => $_SESSION['vecino_email'] ?? ''
];

// El sidebar y otros elementos podrían ser diferentes para vecinos, 
// o podemos usar funciones genéricas si existen.
?>