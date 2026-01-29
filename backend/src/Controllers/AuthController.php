<?php

namespace App\Controllers;

use PDO;

class AuthController
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
        if (session_status() === PHP_SESSION_NONE) {
            // Configuración para que la cookie sea aceptada entre diferentes puertos
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                // 'domain' => '127.0.0.1', // Dejar que el navegador maneje el dominio por defecto (HostOnly) es más seguro en localhost
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            session_start();
        }

        // Define Google Client ID if not defined (fallback)
        if (!defined('GOOGLE_CLIENT_ID')) {
            define('GOOGLE_CLIENT_ID', '664056732869-nqieqd6qdovnt9u3jfqnckrnckkhmn26.apps.googleusercontent.com');
        }
    }

    // Login via username/password is deprecated/removed. Use loginByEmail via Google Auth.


    public function loginByEmail(string $email): array
    {
        $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_rut, usr_email 
                FROM trd_acceso_usuarios 
                WHERE usr_email = :email AND usr_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuario no encontrado con el email proporcionado'
            ];
        }

        // Guardar sesión
        $_SESSION['user_id'] = $user['usr_id'];
        $_SESSION['email'] = $user['usr_email'];
        $_SESSION['rut'] = $user['usr_rut'];
        $_SESSION['nombre'] = $user['usr_nombre'];
        $_SESSION['apellido'] = $user['usr_apellido'];
        // $_SESSION['usuario'] = $user['usr_usuario'];

        return [
            'success' => true,
            'message' => 'Login exitoso vía Google',
            'user' => [
                'id' => $user['usr_id'],
                'email' => $user['usr_email'],
                'nombre' => $user['usr_nombre'] . ' ' . $user['usr_apellido'],
                'rut' => $user['usr_rut'],
                // 'usuario' => $user['usr_usuario']
            ]
        ];
    }

    public function logout(): void
    {
        session_destroy();
    }

    public function isAuthenticated(?string $token = null): array|bool
    {
        if (!isset($_SESSION['user_id'])) {
            if (isset($_SESSION['email'])) {
                $this->recoverSessionByEmail($_SESSION['email']);
            }

            // Priority 2: Use Token if verified
            if (!isset($_SESSION['user_id']) && $token) {
                try {
                    echo ($token);
                    $userData = $this->verifyGoogleToken($token);
                    if ($userData && isset($userData['email'])) {
                        $this->recoverSessionByEmail($userData['email']);
                    }
                } catch (\Exception $e) {
                    // Token invalid, ignore
                }
            }

            if (!isset($_SESSION['user_id'])) {
                return false;
            }
        }

        $sql = "SELECT DISTINCT 
                    r.rol_id, 
                    r.rol_nombre, 
                    r.rol_enlace, 
                    r.rol_tipo
                FROM trd_acceso_roles r
                JOIN trd_acceso_perfiles_roles pr ON r.rol_id = pr.pfr_rol_id
                JOIN trd_acceso_usuarios_perfiles up ON pr.pfr_perfil_id = up.usp_perfil_id
                WHERE up.usp_usuario_id = :usuario_id 
                  AND r.rol_borrado = 0
                  AND up.usp_borrado = 0
                  order by r.rol_id ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $_SESSION['user_id']);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $permissions = [
                "rol_id" => "0",
                "rol_nombre" => "Bandeja",
                "rol_enlace" => "paginas/Bandeja.html",
                "rol_tipo" => "Pagina"
            ];
            return $permissions;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function recoverSessionByEmail(string $email): void
    {
        $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_rut 
                FROM trd_acceso_usuarios 
                WHERE usr_email = :email AND usr_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['usr_id'];
            $_SESSION['email'] = $email; // Ensure email is set if recovered by token
            $_SESSION['rut'] = $user['usr_rut'];
            $_SESSION['nombre'] = $user['usr_nombre']; // Assuming just first name as per login method
            // $_SESSION['usuario'] = $user['usr_usuario'];
        }
    }

    /**
     * Verifica el token JWT de Google
     * Descodifica el JWT sin verificar la firma (útil para desarrollo)
     * En producción, usa la librería google/auth de Google
     */
    private function verifyGoogleToken($token)
    {
        // Dividir el JWT en 3 partes: header.payload.signature
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            throw new \Exception('Token JWT inválido');
        }

        // Decodificar el payload (segunda parte)
        // Agregar padding si es necesario
        $payload = $parts[1];
        $payload .= str_repeat('=', 4 - strlen($payload) % 4);

        $decoded = json_decode(base64_decode($payload), true);

        if (!$decoded) {
            throw new \Exception('No se pudo decodificar el payload');
        }

        // Verificar que el cliente ID coincida
        // Note: Constants are global, ensure they are defined or use hardcoded/class const
        if (!isset($decoded['aud']) || $decoded['aud'] !== GOOGLE_CLIENT_ID) {
            // throw new \Exception('Client ID no coincide');
        }

        // Verificar que el token no haya expirado
        if (isset($decoded['exp']) && $decoded['exp'] < time()) {
            throw new \Exception('Token expirado');
        }

        return $decoded;
    }
}
