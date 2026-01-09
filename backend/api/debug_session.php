<?php
require_once 'cors.php';

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Content-Type: application/json; charset=UTF-8");

echo json_encode([
    'session_id' => session_id(),
    'session_data' => $_SESSION,
    'status' => session_status(),
    'cookie_params' => session_get_cookie_params()
]);
?>