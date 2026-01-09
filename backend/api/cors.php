<?php
// cors.php - Manejo de CORS para la API
ob_start();

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

// Error handler to ensure we always return JSON even on PHP errors
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno))
        return;
    if (ob_get_length())
        ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error_type' => 'PHP_ERROR',
        'message' => $errstr,
        'file' => basename($errfile),
        'line' => $errline
    ]);
    exit;
});

set_exception_handler(function ($e) {
    if (ob_get_length())
        ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error_type' => 'PHP_EXCEPTION',
        'message' => $e->getMessage(),
        'file' => basename($e->getFile()),
        'line' => $e->getLine()
    ]);
    exit;
});

// Remove existing headers to avoid duplicates
header_remove("Access-Control-Allow-Origin");
header_remove("Access-Control-Allow-Credentials");
header_remove("Access-Control-Allow-Methods");
header_remove("Access-Control-Allow-Headers");

// Origin handling
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowed_origins = [
    'http://127.0.0.1:5501',
    'http://localhost:5501',
    'http://127.0.0.1:5500',
    'http://localhost:5500',
    'http://127.0.0.1',
    'http://localhost',
    'http://172.0.0.1'
];

if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
} elseif (preg_match('/^https?:\/\/(localhost|127\.0\.0\.1)(:\d+)?$/', $origin)) {
    // Allow any local port in development
    header("Access-Control-Allow-Origin: $origin");
} else {
    // If no origin (direct access) or not in list, default to *
    // BUT only if we don't have credentials clashing. 
    // For safer behavior in dev, we just echo the origin if it exists.
    if ($origin) {
        header("Access-Control-Allow-Origin: $origin");
    } else {
        header("Access-Control-Allow-Origin: *");
    }
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Handle preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Restringir a POST para todos los demás casos
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}

// Recolectar datos JSON globalmente
$input = file_get_contents("php://input");
$data = json_decode($input, true) ?? [];

// Validar que exista la ACCION para todos los POST
if (!isset($data['ACCION'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ACCION is required"]);
    exit;
}
//exit;