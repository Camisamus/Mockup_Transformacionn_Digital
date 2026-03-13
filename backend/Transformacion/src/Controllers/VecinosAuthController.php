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
     * Login para vecinos validando contra trd_acceso_vecinos con RUT y Clave
     */
    public function loginByRut(string $rut, string $password): array
    {
        $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_rut, usr_email, usr_clave 
                FROM trd_acceso_vecinos 
                WHERE usr_rut = :rut AND usr_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();

        $vecino = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$vecino) {
            return [
                'success' => false,
                'message' => 'RUT no registrado en el sistema de acceso.'
            ];
        }

        if (empty($vecino['usr_clave']) || !password_verify($password, $vecino['usr_clave'])) {
            return [
                'success' => false,
                'message' => 'Clave de acceso incorrecta.'
            ];
        }

        return $this->setSession([
            'tgc_id' => $vecino['usr_id'],
            'tgc_nombre' => $vecino['usr_nombre'],
            'tgc_apellido_paterno' => $vecino['usr_apellido'],
            'tgc_rut' => $vecino['usr_rut'],
            'tgc_correo_electronico' => $vecino['usr_email']
        ]);
    }

    /**
     * Busca un contribuyente por RUT para pre-cargar datos
     */
    public function buscarContribuyentePorRut(string $rut): array
    {
        $sql = "SELECT tgc_id, tgc_nombre, tgc_apellido_paterno, tgc_apellido_materno, tgc_correo_electronico, tgc_telefono_contacto 
                FROM trd_general_contribuyentes 
                WHERE tgc_rut = :rut AND tgc_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return ['success' => true, 'data' => $data];
        }

        return ['success' => false, 'message' => 'No encontrado'];
    }

    /**
     * Registro de nuevo vecino (Contribuyente + Acceso)
     */
    public function registerContribuyente(array $data): array
    {
        $rut = $data['tgc_rut'] ?? '';

        // 1. Verificar si ya tiene acceso en trd_acceso_vecinos
        $checkAcceso = "SELECT usr_id FROM trd_acceso_vecinos WHERE usr_rut = :rut AND usr_borrado = 0 LIMIT 1";
        $stmtCheck = $this->conn->prepare($checkAcceso);
        $stmtCheck->bindParam(':rut', $rut);
        $stmtCheck->execute();
        if ($stmtCheck->fetch()) {
            return ['success' => false, 'message' => 'El RUT ya tiene una cuenta de acceso activa.'];
        }

        $hashedPassword = password_hash($data['tgc_clave_acceso'], PASSWORD_DEFAULT);
        $this->conn->beginTransaction();

        try {
            // 2. Manejar trd_general_contribuyentes
            $checkGeneral = "SELECT tgc_id FROM trd_general_contribuyentes WHERE tgc_rut = :rut LIMIT 1";
            $stmtGen = $this->conn->prepare($checkGeneral);
            $stmtGen->bindParam(':rut', $rut);
            $stmtGen->execute();
            $existingGen = $stmtGen->fetch(PDO::FETCH_ASSOC);

            if ($existingGen) {
                // Actualizar (ignorando campos restringidos)
                $sqlGen = "UPDATE trd_general_contribuyentes SET 
                            tgc_nombre = :nombre,
                            tgc_apellido_paterno = :paterno,
                            tgc_apellido_materno = :materno,
                            tgc_correo_electronico = :email,
                            tgc_telefono_contacto = :telefono,
                            tgc_acepta_privacidad = :privacidad,
                            tgc_fecha_acepta_privacidad = NOW()
                          WHERE tgc_id = :id";
                $stmtStep1 = $this->conn->prepare($sqlGen);
                $stmtStep1->bindParam(':id', $existingGen['tgc_id']);
            } else {
                // Insertar nuevo contribuyente
                $sqlGen = "INSERT INTO trd_general_contribuyentes (
                            tgc_rut, tgc_nombre, tgc_apellido_paterno, tgc_apellido_materno, 
                            tgc_correo_electronico, tgc_telefono_contacto, tgc_acepta_privacidad, tgc_fecha_acepta_privacidad
                          ) VALUES (
                            :rut, :nombre, :paterno, :materno, :email, :telefono, :privacidad, NOW()
                          )";
                $stmtStep1 = $this->conn->prepare($sqlGen);
                $stmtStep1->bindParam(':rut', $rut);
            }

            $stmtStep1->bindParam(':nombre', $data['tgc_nombre']);
            $stmtStep1->bindParam(':paterno', $data['tgc_apellido_paterno']);
            $stmtStep1->bindParam(':materno', $data['tgc_apellido_materno']);
            $stmtStep1->bindParam(':email', $data['tgc_correo_electronico']);
            $stmtStep1->bindParam(':telefono', $data['tgc_telefono_contacto']);
            $privacidadVal = $data['tgc_acepta_privacidad'] ?? 1;
            $stmtStep1->bindParam(':privacidad', $privacidadVal);
            $stmtStep1->execute();

            // 3. Manejar trd_acceso_vecinos
            $sqlAcceso = "INSERT INTO trd_acceso_vecinos (usr_rut, usr_nombre, usr_apellido, usr_email, usr_clave, usr_creacion)
                          VALUES (:rut, :nombre, :apellido, :email, :clave, NOW())";
            $stmtStep2 = $this->conn->prepare($sqlAcceso);
            $stmtStep2->bindParam(':rut', $rut);
            $stmtStep2->bindParam(':nombre', $data['tgc_nombre']);
            $apellidoCompuesto = trim($data['tgc_apellido_paterno'] . ' ' . $data['tgc_apellido_materno']);
            $stmtStep2->bindParam(':apellido', $apellidoCompuesto);
            $stmtStep2->bindParam(':email', $data['tgc_correo_electronico']);
            $stmtStep2->bindParam(':clave', $hashedPassword);
            $stmtStep2->execute();

            $this->conn->commit();

            // 4. Enviar correo de bienvenida
            if ($this->mailService) {
                $this->sendWelcomeEmail($existingGen ? (int) $existingGen['tgc_id'] : (int) $this->conn->lastInsertId(), $data);
            }

            return ['success' => true, 'message' => 'Registro exitoso. Se ha enviado un correo de bienvenida.'];

        } catch (\Exception $e) {
            $this->conn->rollBack();
            return ['success' => false, 'message' => 'Error al procesar el registro: ' . $e->getMessage()];
        }
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

    public function loginByEmail(string $email, string $password): array
    {
        $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_rut, usr_email, usr_clave 
                FROM trd_acceso_vecinos 
                WHERE usr_email = :email AND usr_borrado = 0
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $vecino = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($vecino && !empty($vecino['usr_clave']) && password_verify($password, $vecino['usr_clave'])) {
            return $this->setSession([
                'tgc_id' => $vecino['usr_id'],
                'tgc_correo_electronico' => $vecino['usr_email'],
                'tgc_rut' => $vecino['usr_rut'],
                'tgc_nombre' => $vecino['usr_nombre'],
                'tgc_apellido_paterno' => $vecino['usr_apellido']
            ]);
        }

        return ['success' => false, 'message' => 'Credenciales incorrectas.'];
    }

    /**
     * Solicita recuperación de contraseña
     */
    public function requestPasswordReset(string $email): array
    {
        $sql = "SELECT usr_id, usr_nombre, usr_rut FROM trd_acceso_vecinos WHERE usr_email = :email AND usr_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ['success' => false, 'message' => 'El correo electrónico no está registrado.'];
        }

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+2 hours'));

        // Necesitamos una tabla para tokens o usar un campo en trd_acceso_vecinos
        // Por simplicidad para el mockup, intentaremos añadir la columna si no existe
        try {
            $this->conn->exec("ALTER TABLE trd_acceso_vecinos ADD COLUMN IF NOT EXISTS usr_reset_token VARCHAR(255) DEFAULT NULL, ADD COLUMN IF NOT EXISTS usr_reset_expires DATETIME DEFAULT NULL");
        } catch (\Exception $e) {
        }

        $update = "UPDATE trd_acceso_vecinos SET usr_reset_token = :token, usr_reset_expires = :expires WHERE usr_id = :id";
        $stmtUp = $this->conn->prepare($update);
        $stmtUp->bindParam(':token', $token);
        $stmtUp->bindParam(':expires', $expires);
        $stmtUp->bindParam(':id', $user['usr_id']);
        $stmtUp->execute();

        if ($this->mailService) {
            $link = "http://192.168.0.169/Transformacion/vecinos/restablecer_password.php?token=" . $token;
            $nombre = $user['usr_nombre'];
            $asunto = "Recuperación de Contraseña - Portal de Vecinos";
            $cuerpo = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px;'>
                <h2 style='color: #006FB3;'>Recuperación de Contraseña</h2>
                <p>Hola {$nombre},</p>
                <p>Has solicitado restablecer tu contraseña. Haz clic en el siguiente botón para continuar:</p>
                <p style='text-align: center; margin: 30px 0;'>
                    <a href='{$link}' style='background-color: #006FB3; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;'>Restablecer Contraseña</a>
                </p>
                <p>Este enlace expirará en 2 horas.</p>
                <p style='font-size: 12px; color: #64748b;'>Si no has solicitado este cambio, puedes ignorar este correo.</p>
            </div>";

            $this->mailService->enviar([
                'expediente_id' => 1,
                'destinatario_email' => $email,
                'asunto' => $asunto,
                'cuerpo' => $cuerpo,
                'from_name' => 'Municipalidad de Viña del Mar'
            ]);
        }

        return ['success' => true, 'message' => 'Se ha enviado un correo con instrucciones para restablecer su contraseña.'];
    }

    /**
     * Procesa el cambio de contraseña con token
     */
    public function resetPassword(string $token, string $newPassword): array
    {
        $sql = "SELECT usr_id FROM trd_acceso_vecinos WHERE usr_reset_token = :token AND usr_reset_expires > NOW() AND usr_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ['success' => false, 'message' => 'El enlace es inválido o ha expirado.'];
        }

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = "UPDATE trd_acceso_vecinos SET usr_clave = :pass, usr_reset_token = NULL, usr_reset_expires = NULL WHERE usr_id = :id";
        $stmtUp = $this->conn->prepare($update);
        $stmtUp->bindParam(':pass', $hashed);
        $stmtUp->bindParam(':id', $user['usr_id']);

        if ($stmtUp->execute()) {
            return ['success' => true, 'message' => 'Su contraseña ha sido actualizada correctamente.'];
        }

        return ['success' => false, 'message' => 'No se pudo actualizar la contraseña.'];
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
