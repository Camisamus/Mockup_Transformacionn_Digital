<?php
if (session_status() === PHP_SESSION_NONE) {
    header('Content-Type: text/html; charset=utf-8');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false, // Set to true in production with HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}
