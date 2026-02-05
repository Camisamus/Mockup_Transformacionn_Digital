<?php
require_once 'session_start.php';

use App\Config\Database;
use App\Controllers\AuthController;

// Handle GET request for direct link access
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../vendor/autoload.php';

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
    header("Location: ../index.php");
    exit;
}

// Check for POST (API usage)
require_once 'cors.php'; // This might double-include session_start.php but that's handled by require_once. BUT cors.php enforces POST.
// Wait, if we use cors.php here it will blocking GET.
// So we must NOT include cors.php if it is a GET request. 
// But if it is POST, we want CORS headers.
// Let's just handle everything manually here.

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

$authController = new AuthController($db);
$authController->logout();

echo json_encode([
    'success' => true,
    'message' => 'Sesión cerrada correctamente'
]);
?>