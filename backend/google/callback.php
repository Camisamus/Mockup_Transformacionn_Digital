<?php
session_start();

// Tu secreto de cliente (NO lo expongas en producción)

require_once __DIR__ . '/../api/cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $data is populated by cors.php

    if (!isset($data['token'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Token no proporcionado']);
        exit;
    }

    $token = $data['token'];

    try {
        $userData = verifyGoogleToken($token);

        if ($userData) {
            $database = new Database();
            $db = $database->getConnection();
            $authController = new AuthController($db);

            $result = $authController->loginByEmail($userData['email']);

            if ($result['success']) {
                $_SESSION['google_picture'] = $userData['picture'];

                echo json_encode([
                    'success' => true,
                    'user' => $result['user'],
                    'message' => 'Autenticado correctamente'
                ]);
            } else {
                http_response_code(401);
                echo json_encode([
                    'success' => false,
                    'error' => 'El correo ' . $userData['email'] . ' no está registrado.'
                ]);
            }
        } else {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Token inválido']);
        }
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}

/**
 * Verifica el token JWT de Google
 * Descodifica el JWT sin verificar la firma (útil para desarrollo)
 * En producción, usa la librería google/auth de Google
 */
function verifyGoogleToken($token)
{
    // Dividir el JWT en 3 partes: header.payload.signature
    $parts = explode('.', $token);

    if (count($parts) !== 3) {
        throw new Exception('Token JWT inválido');
    }

    // Decodificar el payload (segunda parte)
    // Agregar padding si es necesario
    $payload = $parts[1];
    $payload .= str_repeat('=', 4 - strlen($payload) % 4);

    $decoded = json_decode(base64_decode($payload), true);

    if (!$decoded) {
        throw new Exception('No se pudo decodificar el payload');
    }

    // Verificar que el cliente ID coincida
    if (!isset($decoded['aud']) || $decoded['aud'] !== GOOGLE_CLIENT_ID) {
        throw new Exception('Client ID no coincide');
    }

    // Verificar que el token no haya expirado
    if (isset($decoded['exp']) && $decoded['exp'] < time()) {
        throw new Exception('Token expirado');
    }

    return $decoded;
}
?>