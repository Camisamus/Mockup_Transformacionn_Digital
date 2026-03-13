<?php
require_once 'session_start.php';

require_once 'app_autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\general_vecinosauthcontroller;

// Handle GET request for direct link access
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../../vendor/autoload.php';

    // Destroy session
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();

    // Redirect to login
    // Redirect to login de vecinos
    header("Location: ../../acceso_vecinos.php");
    exit;
}

// Check for POST (API usage)
require_once 'cors.php';

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

$authController = new general_vecinosauthcontroller($db);
$authController->logout();

echo json_encode([
    'success' => true,
    'message' => 'Sesión cerrada correctamente'
]);
?>