<?php

namespace App\Controllers;

use PDO;

class VecinosAuthController
{
    private PDO $conn;
    private $mailService;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
        
        // Cargar MailService si está disponible
        if (class_exists('App\Helpers\MailService')) {
            $this->mailService = new \App\Helpers\MailService($this->conn);
        }
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
     * Login para vecinos validando contra trd_general_contribuyentes con RUT y Clave
     */
    public function loginByRut(string $rut, string $password): array
    {
        $sql = "SELECT tgc_id, tgc_nombre, tgc_apellido_paterno, tgc_rut, tgc_correo_electronico, tgc_clave_acceso 
                FROM trd_general_contribuyentes 
                WHERE tgc_rut = :rut AND tgc_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();

        $vecino = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$vecino) {
            return [
                'success' => false,
                'message' => 'RUT no registrado.'
            ];
        }

        // Verificar clave (asumiendo hash o texto plano por ahora, preferible password_verify)
        // El usuario pidió "incorporar una clave", así que si no existe el campo lo manejaremos
        if (!isset($vecino['tgc_clave_acceso']) || !password_verify($password, $vecino['tgc_clave_acceso'])) {
            return [
                'success' => false,
                'message' => 'Clave de acceso incorrecta.'
            ];
        }

        return $this->setSession($vecino);
    }

    /**
     * Registro de nuevo contribuyente
     */
    public function registerContribuyente(array $data): array
    {
        // 1. Verificamos si el RUT ya existe y si tiene clave
        $check = "SELECT tgc_id, tgc_clave_acceso FROM trd_general_contribuyentes WHERE tgc_rut = :rut LIMIT 1";
        $stmtCheck = $this->conn->prepare($check);
        $stmtCheck->bindParam(':rut', $data['tgc_rut']);
        $stmtCheck->execute();
        $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($existing && !empty($existing['tgc_clave_acceso'])) {
            return ['success' => false, 'message' => 'El RUT ya se encuentra registrado y tiene una cuenta activa.'];
        }

        $hashedPassword = password_hash($data['tgc_clave_acceso'], PASSWORD_DEFAULT);
        $privacidad = isset($data['tgc_acepta_privacidad']) && $data['tgc_acepta_privacidad'] == 1 ? 1 : 0;

        try {
            if ($existing) {
                // Si EXISTE pero NO TIENE CLAVE, actualizamos el registro (Activación)
                $sql = "UPDATE trd_general_contribuyentes SET 
                            tgc_tipo = :tipo,
                            tgc_nombre = :nombre,
                            tgc_apellido_paterno = :paterno,
                            tgc_apellido_materno = :materno,
                            tgc_correo_electronico = :email,
                            tgc_telefono_contacto = :telefono,
                            tgc_clave_acceso = :clave,
                            tgc_acepta_privacidad = :privacidad,
                            tgc_fecha_acepta_privacidad = NOW()
                        WHERE tgc_id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $existing['tgc_id'], PDO::PARAM_INT);
            } else {
                // Si NO EXISTE, creamos un registro nuevo
                $sql = "INSERT INTO trd_general_contribuyentes (
                            tgc_rut, tgc_tipo, tgc_nombre, tgc_apellido_paterno, tgc_apellido_materno, 
                            tgc_correo_electronico, tgc_telefono_contacto, tgc_clave_acceso, tgc_acepta_privacidad, tgc_fecha_acepta_privacidad
                        ) VALUES (
                            :rut, :tipo, :nombre, :paterno, :materno, 
                            :email, :telefono, :clave, :privacidad, NOW()
                        )";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':rut', $data['tgc_rut']);
            }

            $stmt->bindParam(':tipo', $data['tgc_tipo']);
            $stmt->bindParam(':nombre', $data['tgc_nombre']);
            $stmt->bindParam(':paterno', $data['tgc_apellido_paterno']);
            $stmt->bindParam(':materno', $data['tgc_apellido_materno']);
            $stmt->bindParam(':email', $data['tgc_correo_electronico']);
            $stmt->bindParam(':telefono', $data['tgc_telefono_contacto']);
            $stmt->bindParam(':clave', $hashedPassword);
            $stmt->bindParam(':privacidad', $privacidad);
            
            if ($stmt->execute()) {
                $targetId = $existing ? (int)$existing['tgc_id'] : (int)$this->conn->lastInsertId();
                
                // Enviar correo de bienvenida
                if ($this->mailService) {
                    $this->sendWelcomeEmail($targetId, $data);
                }

                $msg = $existing ? 'Cuenta activada correctamente.' : 'Registro exitoso.';
                return ['success' => true, 'message' => "{$msg} Se ha enviado un correo de bienvenida. Ahora puede iniciar sesión."];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error al procesar el registro: ' . $e->getMessage()];
        }

        return ['success' => false, 'message' => 'No se pudo completar la operación.'];
    }
    /**
     * Envía un correo de bienvenida al vecino recién registrado
     */
    private function sendWelcomeEmail(int $contribuyenteId, array $data): void
    {
        $nombre = $data['tgc_nombre'] . ' ' . $data['tgc_apellido_paterno'];
        $email = $data['tgc_correo_electronico'];
        $rut = $data['tgc_rut'];
        $clave = $data['tgc_clave_acceso'];

        $asunto = "Bienvenido al Portal de Vecinos - Municipalidad de Viña del Mar";
        
        $cuerpo = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; color: #1e293b;'>
            <div style='background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%); padding: 30px; text-align: center;'>
                <h1 style='color: white; margin: 0; font-size: 24px;'>¡Bienvenido/a, {$nombre}!</h1>
            </div>
            <div style='padding: 30px; line-height: 1.6;'>
                <p>Nos complace darte la bienvenida al <strong>Portal de Vecinos de la Ilustre Municipalidad de Viña del Mar</strong>.</p>
                <p>Tu cuenta ha sido creada exitosamente. Desde ahora podrás realizar trámites y gestiones municipales de forma digital.</p>
                
                <div style='background-color: #f8fafc; border-radius: 8px; padding: 20px; margin: 25px 0;'>
                    <h3 style='margin-top: 0; color: #006FB3; font-size: 16px;'>Tus credenciales de acceso:</h3>
                    <p style='margin: 5px 0;'><strong>RUT:</strong> {$rut}</p>
                    <p style='margin: 5px 0;'><strong>Clave:</strong> {$clave}</p>
                    <p style='font-size: 12px; color: #64748b; margin-top: 10px;'><em>Recuerda que puedes cambiar tu clave tras ingresar al portal.</em></p>
                </div>

                <h3 style='color: #0f172a; font-size: 16px;'>Protección de tus datos:</h3>
                <p style='font-size: 14px; color: #475569;'>Te recordamos que tu información está protegida bajo la <strong>Ley N° 19.628 sobre Protección de la Vida Privada</strong>. La Municipalidad trata tus datos con estricta confidencialidad y solo para fines de gestión municipal.</p>
                
                <p style='margin-top: 30px; text-align: center;'>
                    <a href='http://192.168.0.169/Transformacion/acceso_vecinos.php' style='background-color: #006FB3; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;'>Ingresar al Portal</a>
                </p>
            </div>
            <div style='background-color: #f1f5f9; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8;'>
                Este es un mensaje automático, por favor no respondas.<br>
                &copy; 2026 Ilustre Municipalidad de Viña del Mar
            </div>
        </div>";

        try {
            $this->mailService->enviar([
                'expediente_id' => 1,
                'destinatario_email' => $email,
                'asunto' => $asunto,
                'cuerpo' => $cuerpo,
                'contribuyente_id' => $contribuyenteId,
                'from_name' => 'Municipalidad de Viña del Mar'
            ]);
        } catch (\Exception $e) {
            error_log("Error enviando correo de bienvenida: " . $e->getMessage());
        }
    }

    private function setSession(array $vecino): array
    {
        $_SESSION['vecino_id'] = $vecino['tgc_id'];
        $_SESSION['vecino_email'] = $vecino['tgc_correo_electronico'];
        $_SESSION['vecino_rut'] = $vecino['tgc_rut'];
        $_SESSION['vecino_nombre'] = $vecino['tgc_nombre'];
        $_SESSION['vecino_apellido'] = $vecino['tgc_apellido_paterno'];
        $_SESSION['user_type'] = 'vecino';

        return [
            'success' => true,
            'message' => 'Login exitoso',
            'vecino' => [
                'id' => $vecino['tgc_id'],
                'email' => $vecino['tgc_correo_electronico'],
                'nombre' => $vecino['tgc_nombre'] . ' ' . $vecino['tgc_apellido_paterno'],
                'rut' => $vecino['tgc_rut']
            ]
        ];
    }

    public function loginByEmail(string $email): array
    {
        // ... mantiene compatibilidad si existe trd_acceso_vecinos
        $sql = "SELECT usr_id as id, usr_nombre as nombre, usr_apellido as apellido, usr_rut as rut, usr_email as email 
                FROM trd_acceso_vecinos 
                WHERE usr_email = :email AND usr_borrado = 0
                LIMIT 1";
        
        // Pero priorizamos trd_general_contribuyentes si es necesario
        // Por ahora mantengamos la lógica anterior pero refactorizada para usar setSession
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $vecino = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($vecino) {
            return $this->setSession([
                'tgc_id' => $vecino['id'],
                'tgc_correo_electronico' => $vecino['email'],
                'tgc_rut' => $vecino['rut'],
                'tgc_nombre' => $vecino['nombre'],
                'tgc_apellido_paterno' => $vecino['apellido']
            ]);
        }

        return ['success' => false, 'message' => 'Usuario no encontrado.'];
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
                JOIN trd_acceso_rol_usuario_vecinos up ON pr.pfr_perfil_id = up.usp_rol_id
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
