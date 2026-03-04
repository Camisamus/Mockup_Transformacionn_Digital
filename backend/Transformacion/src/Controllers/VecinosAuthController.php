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

    /**
     * Obtiene los permisos del vecino actual desde las tablas _vecinos
     */
    public function getPermissions(?int $vecinoId = null): array
    {
        $id = $vecinoId ?? ($_SESSION['vecino_id'] ?? null);
        if (!$id)
            return [];

        $sql = "SELECT DISTINCT 
                    r.rol_id, 
                    r.rol_nombre, 
                    r.rol_enlace, 
                    r.rol_simbolo, 
                    r.rol_tipo,
                    r.rol_formato,
                    r.rol_modulo,
                    r.rol_orden
                FROM trd_acceso_permisos_vecinos r
                JOIN trd_acceso_permiso_rol_vecinos pr ON r.rol_id = pr.pfr_rol_id
                JOIN trd_acceso_rol_usuario_vecinos up ON pr.pfr_perfil_id = up.usp_perfil_id
                WHERE up.usp_usuario_id = :vecino_id 
                  AND r.rol_borrado = 0
                  AND up.usp_borrado = 0
                  AND (up.usp_fecha_termino IS NULL OR up.usp_fecha_termino > CURRENT_DATE())
                ORDER BY r.rol_orden ASC";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vecino_id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Si no tiene permisos asignados, devolvemos un menú básico por defecto
            if (empty($permissions)) {
                return [
                    [
                        "rol_id" => "A.0",
                        "rol_nombre" => "Inicio",
                        "rol_enlace" => "vecinos/index.php",
                        "rol_simbolo" => "home",
                        "rol_tipo" => "Pagina",
                        "rol_formato" => "menu",
                        "rol_modulo" => "principal",
                        "rol_orden" => 1
                    ]
                ];
            }

            return $permissions;
        } catch (\Exception $e) {
            error_log("Error fetching vecino permissions: " . $e->getMessage());
            return [];
        }
    }
}
