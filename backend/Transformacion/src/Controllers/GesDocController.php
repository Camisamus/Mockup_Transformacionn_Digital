<?php

namespace App\Controllers;

use App\Models\GesDoc;
use App\Models\Bitacora;
use App\Helpers\FileEncryption;

class GesDocController
{
    private $db;
    private $gesdoc;
    private $bitacora;

    public function __construct($db)
    {
        $this->db = $db;
        $this->gesdoc = new GesDoc($this->db);
        $this->bitacora = new Bitacora($this->db);
    }

    /**
     * Converts base64 encoded file data to $_FILES array format
     * 
     * @param string $base64 Base64 encoded file content (with or without data URI prefix)
     * @param string $filename Original filename
     * @return array Array with 'file' (temp file resource) and 'array' (file info array)
     * @throws \Exception If base64 content is invalid
     */
    public function base64ToFileArray($base64, $filename)
    {
        // Remove data URI prefix if present (e.g., "data:image/png;base64,...")
        if (strpos($base64, ';base64,') !== false) {
            $base64 = explode(';base64,', $base64)[1];
        }

        // Decode base64 content
        $fileData = base64_decode($base64);
        if ($fileData === false || empty($fileData)) {
            throw new \Exception("Invalid base64 content for file: $filename");
        }

        // Create temporary file
        $tmpFile = tmpfile();
        if ($tmpFile === false) {
            throw new \Exception("Failed to create temporary file for: $filename");
        }

        fwrite($tmpFile, $fileData);
        $tmpPath = stream_get_meta_data($tmpFile)['uri'];

        return [
            'file' => $tmpFile, // Keep reference to prevent auto-cleanup
            'array' => [
                'name' => $filename,
                'tmp_name' => $tmpPath,
                'size' => strlen($fileData),
                'error' => 0,
                'type' => mime_content_type($tmpPath) ?: 'application/octet-stream'
            ]
        ];
    }

    /**
     * Upload and encrypt files
     * 
     * @param array $files Files from $_FILES
     * @param array $data Additional data from request (tramite_id, user_id)
     * @return array Response with status and message
     */
    public function subirArchivo($files, $data = [])
    {
        try {
            // Validate that files were received
            if (empty($files)) {
                return [
                    "status" => "error",
                    "message" => "No se recibieron archivos"
                ];
            }

            // Validate required parameters
            if (!isset($data['tramite_id']) || empty($data['tramite_id'])) {
                return [
                    "status" => "error",
                    "message" => "El ID del trámite es requerido"
                ];
            }

            if (!isset($data['user_id']) || empty($data['user_id'])) {
                return [
                    "status" => "error",
                    "message" => "El ID del usuario es requerido"
                ];
            }

            $tramiteId = intval($data['tramite_id']);
            $userId = intval($data['user_id']);

            // Get encryption key
            $encryptionKey = $this->gesdoc->getCamiKey();
            if ($encryptionKey === false) {
                // Try to ensure folder exists (which will create .ck if needed)
                list($success, $folderPath, $error) = $this->gesdoc->ensureMonthlyFolder();
                if (!$success) {
                    return [
                        "status" => "error",
                        "message" => "Error al preparar carpeta de destino: " . $error
                    ];
                }

                // Try to get key again
                $encryptionKey = $this->gesdoc->getCamiKey();
                if ($encryptionKey === false) {
                    return [
                        "status" => "error",
                        "message" => "No se pudo obtener la clave de encriptación"
                    ];
                }
            }

            $uploadedFiles = [];
            $errors = [];

            // Handle multiple files
            // Handle multiple files
            // Check if it's a single file, standard multi-file, or array of file arrays
            if (isset($files['tmp_name']) && !is_array($files['tmp_name'])) {
                // Case 1: Standard Single file ( $_FILES['input'] )
                $filesToProcess = [
                    [
                        'name' => $files['name'],
                        'tmp_name' => $files['tmp_name'],
                        'error' => $files['error'],
                        'type' => $files['type'] ?? 'application/octet-stream',
                        'size' => $files['size'] ?? 0
                    ]
                ];
            } elseif (isset($files['name']) && is_array($files['name'])) {
                // Case 2: Standard Multiple files ( $_FILES['input'][] )
                $filesToProcess = [];
                $fileCount = count($files['name']);
                for ($i = 0; $i < $fileCount; $i++) {
                    $filesToProcess[] = [
                        'name' => $files['name'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'type' => $files['type'][$i] ?? 'application/octet-stream',
                        'size' => $files['size'][$i] ?? 0
                    ];
                }
            } elseif (is_array($files)) {
                // Case 3: Array of file arrays (Manual construction, e.g. from base64 helper)
                $filesToProcess = [];
                foreach ($files as $f) {
                    if (isset($f['name']) && isset($f['tmp_name'])) {
                        $filesToProcess[] = $f;
                    }
                }
            } else {
                return [
                    "status" => "error",
                    "message" => "Formato de archivos inválido"
                ];
            }

            // Process each file
            foreach ($filesToProcess as $file) {
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = "Error al subir archivo: " . $file['name'];
                    continue;
                }

                // Read file content
                $fileContent = file_get_contents($file['tmp_name']);
                if ($fileContent === false) {
                    $errors[] = "No se pudo leer el archivo: " . $file['name'];
                    continue;
                }

                // Capture file metadata
                $fileSize = filesize($file['tmp_name']);
                $mimeType = mime_content_type($file['tmp_name']) ?: $file['type'];
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileHash = hash('sha256', $fileContent);

                // Convert to Base64
                $base64Content = base64_encode($fileContent);

                // Encrypt the Base64 content
                $encryptedContent = FileEncryption::encrypt($base64Content, $encryptionKey);
                if ($encryptedContent === false) {
                    $errors[] = "Error al encriptar el archivo: " . $file['name'];
                    continue;
                }

                // Save encrypted file
                list($success, $filename, $error) = $this->gesdoc->saveEncryptedFile(
                    $encryptedContent,
                    $file['name']
                );

                if (!$success) {
                    $errors[] = "Error al guardar archivo " . $file['name'] . ": " . $error;
                    continue;
                }

                // Save to database
                $fileData = [
                    'original_name' => $file['name'],
                    'encrypted_name' => $filename,
                    'doc_privado' => $data['doc_privado'] ?? 0
                ];

                list($dbSuccess, $docId, $versionId, $dbError) = $this->gesdoc->saveFileToDatabase(
                    $tramiteId,
                    $fileData,
                    $userId
                );

                if ($dbSuccess) {
                    // Save metadata
                    $metadata = [
                        'file_size' => (string) $fileSize,
                        'mime_type' => $mimeType,
                        'extension' => $extension,
                        'hash' => $fileHash,
                        'origin_system' => 'GesDoc',
                        'upload_date' => date('Y-m-d H:i:s'),
                        'user_id' => (string) $userId
                    ];

                    $this->gesdoc->saveFileMetadata($versionId, $metadata);

                    $uploadedFiles[] = [
                        'original_name' => $file['name'],
                        'encrypted_name' => $filename,
                        'doc_id' => $docId,
                        'version_id' => $versionId
                    ];
                } else {
                    $errors[] = "Error al guardar en base de datos " . $file['name'] . ": " . $dbError;
                }
            }

            // Log uploads to Bitacora
            if (count($uploadedFiles) > 0) {
                foreach ($uploadedFiles as $upFile) {
                    try {
                        $tipo = ($data['doc_privado'] ?? 0) == 1 ? "Interno" : "Público";
                        $msg = "Carga de documento $tipo: " . $upFile['original_name'];
                        $this->bitacora->registrar($tramiteId, $msg, $userId);
                    } catch (\Exception $e) {
                        error_log("Error logging to Bitacora: " . $e->getMessage());
                    }
                }
            }

            // Prepare response
            if (count($uploadedFiles) > 0) {
                return [
                    "status" => "success",
                    "message" => "Archivos procesados correctamente",
                    "uploaded" => $uploadedFiles,
                    "errors" => $errors
                ]
                ;
            } else {
                return [
                    "status" => "error",
                    "message" => "No se pudo procesar ningún archivo",
                    "errors" => $errors
                ];
            }
        } catch (\Exception $e) {
            error_log("Error in subirArchivo: " . $e->getMessage());
            return [
                "status" => "error",
                "message" => "Error del servidor: " . $e->getMessage()
            ];
        }
    }

    /**
     * Download and decrypt file (latest version)
     * 
     * @param int $docId Document ID
     * @return void Sends file to browser or returns error
     */
    public function bajarArchivo($docId)
    {
        try {
            // Get latest version data
            $versionData = $this->gesdoc->getLatestDocumentoVersion($docId);
            if ($versionData === false) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Documento no encontrado"
                ]);
                return;
            }

            // Get encryption key from .ck file
            $encryptionKey = $this->gesdoc->getKeyFromCkFile($versionData['doc_partner']);
            if ($encryptionKey === false) {
                echo json_encode([
                    "status" => "error",
                    "message" => "No se pudo obtener la clave de encriptación"
                ]);
                return;
            }

            // Get encrypted file content
            $encryptedContent = $this->gesdoc->getEncryptedFileContent($versionData['doc_enlace_documento']);
            if ($encryptedContent === false) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Archivo encriptado no encontrado"
                ]);
                return;
            }

            // Decrypt the content
            $decryptedBase64 = FileEncryption::decrypt($encryptedContent, $encryptionKey);
            if ($decryptedBase64 === false) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Error al desencriptar el archivo"
                ]);
                return;
            }

            // Decode from Base64
            $fileContent = base64_decode($decryptedBase64);
            if ($fileContent === false) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Error al decodificar el archivo"
                ]);
                return;
            }

            // Get original filename
            $filename = $versionData['doc_nombre_documento'];

            // Send file to browser
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($fileContent));
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: public');

            echo $fileContent;
            exit;

        } catch (\Exception $e) {
            error_log("Error in bajarArchivo: " . $e->getMessage());
            echo json_encode([
                "status" => "error",
                "message" => "Error del servidor: " . $e->getMessage()
            ]);
        }
    }

    /**
     * ⚠️ WARNING: DESTRUCTIVE OPERATION - Delete document permanently
     * 
     * This method permanently deletes files from server and database.
     * ⚠️ DO NOT USE IN OTHER WORKFLOWS
     * ⚠️ THIS ACTION CANNOT BE UNDONE
     * 
     * @param int $docId Document ID to delete
     * @return array Response with status and message
     */
    public function borrarArchivo($docId)
    {
        try {
            list($success, $message, $deletedCount) = $this->gesdoc->deleteDocumento($docId);

            if ($success) {
                return [
                    "status" => "success",
                    "message" => $message,
                    "deleted_files" => $deletedCount
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => $message
                ];
            }
        } catch (\Exception $e) {
            error_log("Error in borrarArchivo: " . $e->getMessage());
            return [
                "status" => "error",
                "message" => "Error del servidor: " . $e->getMessage()
            ];
        }
    }

    /**
     * Search documents by tramite ID
     * 
     * @param int $tramiteId Tramite ID
     * @return array Response with documents list
     */
    public function buscarPorTramite($tramiteId)
    {
        try {
            $documentos = $this->gesdoc->getDocumentosByTramite($tramiteId);

            if ($documentos === false) {
                return [
                    "status" => "error",
                    "message" => "Error al buscar documentos"
                ];
            }

            return [
                "status" => "success",
                "documentos" => $documentos,
                "total" => count($documentos)
            ];
        } catch (\Exception $e) {
            error_log("Error in buscarPorTramite: " . $e->getMessage());
            return [
                "status" => "error",
                "message" => "Error del servidor: " . $e->getMessage()
            ];
        }
    }
}

