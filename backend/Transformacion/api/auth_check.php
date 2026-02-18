<?php
if (session_status() === PHP_SESSION_NONE) {
    // Config same as AuthController just in case
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
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/layout_functions.php';

use App\Config\Database;
use App\Controllers\AuthController;

$database = new Database();
$db = $database->getConnection();
$auth = new AuthController($db);

// Determine Paths
// If this file is included from Funcionarios/, script path is .../Funcionarios/foo.php
// Auth check is in .../api/auth_check.php
// We need to know where we are relative to root to set includes correctly.

// Heuristic: if current script is in 'funcionarios', prefix is '../' or '../../'
$currentScriptPath = $_SERVER['SCRIPT_NAME'];
$pathPrefix = './';
if (stripos($currentScriptPath, '/funcionarios/') !== false) {
    // Count how many directory levels deep we are under the root (where recursos/, api/ live)
    // Root = Transformacion/, funcionarios/ is 1 level deep
    // funcionarios/SISADMIN/ is 2 levels deep => '../../'
    // funcionarios/sisadmin/logs/ is 3 levels deep => '../../../'
    // funcionarios/sisadmin/mantenedores/acceso/ is 4 levels deep => '../../../../'
    $afterFuncionarios = substr($currentScriptPath, stripos($currentScriptPath, '/funcionarios/') + strlen('/funcionarios/'));
    $subDirs = explode('/', $afterFuncionarios);
    // subDirs includes the filename as last element, so depth = count - 1 (for subdirs) + 1 (for funcionarios itself)
    $depth = count($subDirs); // This equals subdirs + filename, which matches levels to go up
    $pathPrefix = str_repeat('../', $depth);
}

// Verify Auth
$permissions = $auth->isAuthenticated(); // This checks session and token

if ($permissions === false) {
    // Redirect to login
    $target = $pathPrefix . 'index.php';
    // If we are already at index.php, do nothing (prevent loop if index.php uses this)
    if (basename($currentScriptPath) !== 'index.php') {
        header("Location: $target");
        exit;
    }
}

// Access Control
$currentFile = basename($currentScriptPath);
$allowed = false;

// Always allow dashboard and bandeja, and common action pages which are often accessed via links
$actionPages = [
    'dashboard.php',
    'index.php',
    'bandeja_historial.php',
    'index.php',
    'logout.php',
    'ingr_consultar.php',
    'ingr_responder.php',
    'ingr_preparar.php',
    'ingr_modificar.php',
    'desve_consultar.php',
    'desve_responder.php',
    'desve_modificar.php'
];

if (in_array($currentFile, $actionPages)) {
    $allowed = true;
} else {
    // Check permissions
    // permissions is flat list
    foreach ($permissions as $p) {
        $link = $p['rol_enlace'] ?? '';
        // normalize link to php
        $link = str_replace('.html', '.php', $link);
        if (strpos($link, $currentFile) !== false) {
            $allowed = true;
            break;
        }
    }
}

// If strict Check fails
if (!$allowed && $permissions !== false && basename($currentScriptPath) !== 'index.php') {
    // Redirect to Bandeja
    header("Location: " . $pathPrefix . "Funcionarios/index.php");
    exit;
}

// Prepare rendering data
$userData = [
    'nombre' => $_SESSION['nombre'] ?? '',
    'apellido' => $_SESSION['apellido'] ?? ''
];



$sidebarHtml = renderSidebar($permissions, $pathPrefix, $currentFile);

?>