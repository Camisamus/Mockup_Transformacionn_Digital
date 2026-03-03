<?php

namespace App\Controllers;

use PDO;

class VecinosAuthController
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
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

        if (!defined('GOOGLE_CLIENT_ID')) {
            define('GOOGLE_CLIENT_ID', '664056732869-nqieqd6qdovnt9u3jfqnckrnckkhmn26.apps.googleusercontent.com');
        }
    }

    /**
     * Login para vecinos validando contra trd_acceso_vecinos
     */
    public function loginByEmail(string $email): array
    {
        $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_rut, usr_email 
                FROM trd_acceso_vecinos 
                WHERE usr_email = :email AND usr_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $vecino = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$vecino) {
            return [
                'success' => false,
                'message' => 'Vecino no encontrado o no autorizado'
            ];
        }

        // Guardar sesión específica para vecinos
        $_SESSION['vecino_id'] = $vecino['usr_id'];
        $_SESSION['vecino_email'] = $vecino['usr_email'];
        $_SESSION['vecino_rut'] = $vecino['usr_rut'];
        $_SESSION['vecino_nombre'] = $vecino['usr_nombre'];
        $_SESSION['vecino_apellido'] = $vecino['usr_apellido'];
        $_SESSION['user_type'] = 'vecino';

        // Compatibilidad con variables usadas en vistas heredadas si es necesario
        $_SESSION['nombre'] = $vecino['usr_nombre'];
        $_SESSION['apellido'] = $vecino['usr_apellido'];

        return [
            'success' => true,
            'message' => 'Login exitoso',
            'vecino' => [
                'id' => $vecino['usr_id'],
                'email' => $vecino['usr_email'],
                'nombre' => $vecino['usr_nombre'] . ' ' . $vecino['usr_apellido'],
                'rut' => $vecino['usr_rut']
            ]
        ];
    }

    public function logout(): void
    {
        session_destroy();
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['vecino_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'vecino';
    }
}
