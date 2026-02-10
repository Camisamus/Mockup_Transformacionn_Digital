<?php
/**
 * Herramienta de Descifrado Standalone para Mockup Transformación Digital
 * Permite subir un archivo .imv y su correspondiente .ck para obtener el archivo original.
 */

$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_imv']) && isset($_FILES['archivo_ck'])) {
    try {
        if ($_FILES['archivo_imv']['error'] !== UPLOAD_ERR_OK || $_FILES['archivo_ck']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Error al subir los archivos.");
        }

        // 1. Leer la clave del archivo .ck
        $ckContent = file_get_contents($_FILES['archivo_ck']['tmp_name']);
        if ($ckContent === false)
            throw new Exception("No se pudo leer el archivo .ck");

        $encryptionKey = '';
        $lines = explode("\n", $ckContent);
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^\[CLAVE\]:(.*)$/', $line, $matches)) {
                $encryptionKey = trim($matches[1]);
                break;
            }
        }

        if (empty($encryptionKey))
            throw new Exception("No se encontró la clave en el archivo .ck");

        // 2. Leer el contenido .imv
        $imvContent = file_get_contents($_FILES['archivo_imv']['tmp_name']);
        if ($imvContent === false)
            throw new Exception("No se pudo leer el archivo .imv");

        // 3. Desencriptar
        // El archivo .imv es Base64(IV + EncryptedData)
        $data = base64_decode($imvContent);
        if ($data === false)
            throw new Exception("El archivo .imv no es un Base64 válido.");

        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        if (strlen($data) < $ivLength)
            throw new Exception("El archivo .imv es demasiado corto.");

        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);

        $keyHash = hash('sha256', $encryptionKey, true);
        $decryptedBase64 = openssl_decrypt($encrypted, 'aes-256-cbc', $keyHash, OPENSSL_RAW_DATA, $iv);

        if ($decryptedBase64 === false)
            throw new Exception("Error al desencriptar. Asegúrese de que el archivo .ck sea el correcto.");

        // El sistema original guarda Base64 del contenido original antes de encriptar
        $originalContent = base64_decode($decryptedBase64);
        if ($originalContent === false)
            throw new Exception("Error al decodificar el contenido original.");

        // 4. Detectar extensión y Forzar descarga
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($originalContent);

        // Mapeo de tipos MIME comunes a extensiones
        $extensiones = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf',
            'application/zip' => 'zip',
            'text/plain' => 'txt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx'
        ];

        $ext = $extensiones[$mimeType] ?? 'bin'; // 'bin' si no lo reconoce
        $nombreArchivo = "Descarga_Descifrada." . $ext;

        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Content-Length: ' . strlen($originalContent));
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: public');

        echo $originalContent;
        exit;

    } catch (Exception $e) {
        $mensaje = $e->getMessage();
        $tipoMensaje = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descifrador de Archivos GesDoc</title>
    <!-- Bootstrap para un diseño rápido y limpio -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 15px;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Descifrador Standalone</h4>
            <small>Mockup Transformación Digital</small>
        </div>
        <div class="card-body p-4">
            <?php if ($mensaje): ?>
                <div class="alert alert-<?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="archivo_imv" class="form-label font-weight-bold">Archivo Encriptado (.imv)</label>
                    <input class="form-control" type="file" id="archivo_imv" name="archivo_imv" accept=".imv" required>
                    <div class="form-text">Sube el archivo de imagen o documento con extensión .imv</div>
                </div>

                <div class="mb-3">
                    <label for="archivo_ck" class="form-label">Archivo de Llave (.ck)</label>
                    <input class="form-control" type="file" id="archivo_ck" name="archivo_ck" accept=".ck" required>
                    <div class="form-text">Sube el archivo .ck que contiene la clave correspondiente.</div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Descifrar y Descargar</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3 text-muted">
            <small>El nombre del archivo será <strong>Descarga_1</strong></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>