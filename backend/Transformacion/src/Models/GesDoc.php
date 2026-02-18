<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Helpers\FileEncryption;

class GesDoc
{
    private $conn;
    private $table_name = "trd_documentos_carpeta";
    private $uploadsBasePath;

    public function __construct($db)
    {
        $this->conn = $db;
        // Define base path for uploads
        $this->uploadsBasePath = __DIR__ . '/../../../uploads/gestordocumental/';
    }

    /**
     * Find .ck file in a folder
     * 
     * @param string $folderPath Folder path to search
     * @return string|false .ck filename or false if not found
     */
    private function findCkFile($folderPath)
    {
        try {
            if (!is_dir($folderPath)) {
                return false;
            }

            $files = scandir($folderPath);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'ck') {
                    return $file;
                }
            }

            return false;
        } catch (\Exception $e) {
            error_log("Error finding .ck file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Ensure monthly folder exists and has .ck key file
     * 
     * @return array [success, folderPath, error]
     */
    public function ensureMonthlyFolder()
    {
        try {
            // Get current month folder name (YYYYMM format)
            $currentMonth = date('Ym'); // e.g., 202602
            $currentFolderPath = $this->uploadsBasePath . $currentMonth;

            // Check if folder exists
            if (!is_dir($currentFolderPath)) {
                // Create the folder
                if (!mkdir($currentFolderPath, 0755, true)) {
                    return [false, null, "No se pudo crear la carpeta: $currentFolderPath"];
                }
            }

            // Check if any .ck file exists
            $ckFile = $this->findCkFile($currentFolderPath);
            if ($ckFile === false) {
                // Try to copy from previous month
                $defaultCkPath = $currentFolderPath . '/.ck';
                $copied = $this->copyCamiFromPreviousMonth($currentMonth, $defaultCkPath);

                if (!$copied) {
                    // If no previous month exists, create a new .ck file with a random key
                    $newKey = FileEncryption::generateEncryptionKey(32);
                    $camiContent = "[CLAVE]:" . $newKey . "\n";
                    if (file_put_contents($defaultCkPath, $camiContent) === false) {
                        return [false, null, "No se pudo crear el archivo .ck"];
                    }
                }
            }

            return [true, $currentFolderPath, null];
        } catch (\Exception $e) {
            error_log("Error in ensureMonthlyFolder: " . $e->getMessage());
            return [false, null, $e->getMessage()];
        }
    }

    /**
     * Copy .ck file from previous month
     * 
     * @param string $currentMonth Current month in YYYYMM format
     * @param string $targetCamiPath Target path for .ck file
     * @return bool Success status
     */
    private function copyCamiFromPreviousMonth($currentMonth, $targetCamiPath)
    {
        try {
            // Calculate previous month
            $year = intval(substr($currentMonth, 0, 4));
            $month = intval(substr($currentMonth, 4, 2));

            // Go back one month
            $month--;
            if ($month < 1) {
                $month = 12;
                $year--;
            }

            $previousMonth = sprintf('%04d%02d', $year, $month);
            $previousFolderPath = $this->uploadsBasePath . $previousMonth;

            // Find any .ck file in previous month
            $previousCkFile = $this->findCkFile($previousFolderPath);
            if ($previousCkFile !== false) {
                $previousCamiPath = $previousFolderPath . '/' . $previousCkFile;
                return copy($previousCamiPath, $targetCamiPath);
            }

            return false;
        } catch (\Exception $e) {
            error_log("Error copying .ck from previous month: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get encryption key from .ck file
     * 
     * @return string|false Encryption key or false on failure
     */
    public function getCamiKey()
    {
        try {
            $camiData = $this->readCkFile();
            if ($camiData === false) {
                return false;
            }

            return $camiData['CLAVE'] ?? false;
        } catch (\Exception $e) {
            error_log("Error reading .ck key: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get .ck filename from current month folder
     * 
     * @return string|false .ck filename or false if not found
     */
    public function getCkFilename()
    {
        try {
            $currentMonth = date('Ym');
            $currentFolderPath = $this->uploadsBasePath . $currentMonth;

            return $this->findCkFile($currentFolderPath);
        } catch (\Exception $e) {
            error_log("Error getting .ck filename: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Read all data from .ck file
     * 
     * @return array|false Associative array with all data or false on failure
     */
    public function readCkFile()
    {
        try {
            $currentMonth = date('Ym');
            $currentFolderPath = $this->uploadsBasePath . $currentMonth;

            // Find any .ck file in the folder
            $ckFile = $this->findCkFile($currentFolderPath);
            if ($ckFile === false) {
                return false;
            }

            $camiFilePath = $currentFolderPath . '/' . $ckFile;

            if (!file_exists($camiFilePath)) {
                return false;
            }

            $content = file_get_contents($camiFilePath);
            if ($content === false) {
                return false;
            }

            // Parse the file content
            $data = [];
            $lines = explode("\n", $content);

            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }

                // Parse format: [KEY]:value
                if (preg_match('/^\[([^\]]+)\]:(.*)$/', $line, $matches)) {
                    $key = trim($matches[1]);
                    $value = trim($matches[2]);
                    $data[$key] = $value;
                }
            }

            return $data;
        } catch (\Exception $e) {
            error_log("Error reading .ck file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Write data to .ck file
     * 
     * @param array $data Associative array with data to write
     * @return bool Success status
     */
    public function writeCkFile($data)
    {
        try {
            $currentMonth = date('Ym');
            $currentFolderPath = $this->uploadsBasePath . $currentMonth;

            // Find existing .ck file or use default
            $ckFile = $this->findCkFile($currentFolderPath);
            if ($ckFile === false) {
                $ckFile = '.ck'; // Default name if none exists
            }

            $camiFilePath = $currentFolderPath . '/' . $ckFile;

            // Ensure folder exists
            $currentFolderPath = $this->uploadsBasePath . $currentMonth;
            if (!is_dir($currentFolderPath)) {
                if (!mkdir($currentFolderPath, 0755, true)) {
                    return false;
                }
            }

            // Build content in format [KEY]:value
            $content = '';
            foreach ($data as $key => $value) {
                $content .= "[$key]:$value\n";
            }

            return file_put_contents($camiFilePath, $content) !== false;
        } catch (\Exception $e) {
            error_log("Error writing .ck file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save encrypted file to monthly folder
     * 
     * @param string $encryptedData Encrypted data to save
     * @param string $originalFilename Original filename for reference
     * @return array [success, filename, error]
     */
    public function saveEncryptedFile($encryptedData, $originalFilename = '')
    {
        try {
            // Ensure folder exists
            list($success, $folderPath, $error) = $this->ensureMonthlyFolder();
            if (!$success) {
                return [false, null, $error];
            }

            // Generate filename: {YYMMDDHHmm}{5-char-random}.imv
            $timestamp = date('ymdHi'); // e.g., 2602060814
            $randomKey = FileEncryption::generateRandomKey(5);
            $filename = $timestamp . $randomKey . '.imv';
            $filepath = $folderPath . '/' . $filename;

            // Save the encrypted data
            if (file_put_contents($filepath, $encryptedData) === false) {
                return [false, null, "No se pudo guardar el archivo encriptado"];
            }

            return [true, $filename, null];
        } catch (\Exception $e) {
            error_log("Error saving encrypted file: " . $e->getMessage());
            return [false, null, $e->getMessage()];
        }
    }

    /**
     * Create document adjunto record
     * 
     * @param int $tramiteId Tramite ID
     * @return int|false Document ID or false on failure
     */
    public function createDocumentoAdjunto($tramiteId)
    {
        try {
            $sql = "INSERT INTO trd_general_documento_adjunto 
                    (doc_tramite_registrado, doc_fecha, doc_version_actual) 
                    VALUES (:tramite_id, NOW(), 0)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tramite_id', $tramiteId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            }

            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . ($errorInfo[2] ?? "Unknown error");
            // If explicit error handling is needed, throw exception
            throw new \Exception($errorMsg);

        } catch (PDOException $e) {
            error_log("Error creating documento adjunto: " . $e->getMessage());
            throw $e; // Re-throw to be caught by saveFileToDatabase
        }
    }

    /**
     * Create document version record
     * 
     * @param int $docId Document adjunto ID
     * @param array $versionData Version data
     * @return int|false Version ID or false on failure
     */
    public function createDocumentoVersion($docId, $versionData)
    {
        try {
            $sql = "INSERT INTO trd_general_documento_adjunto_versiones 
                    (docv_doc_id, doc_fecha, doc_enlace_documento, doc_nombre_documento, 
                     `doc-responsable`, doc_docdigital, doc_partner, doc_privado) 
                    VALUES (:doc_id, NOW(), :enlace, :nombre, :responsable, :docdigital, :partner, :privado)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':doc_id', $docId, PDO::PARAM_INT);
            $stmt->bindParam(':enlace', $versionData['enlace'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $versionData['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':responsable', $versionData['responsable'], PDO::PARAM_INT);
            $stmt->bindParam(':docdigital', $versionData['docdigital'], PDO::PARAM_BOOL);
            $stmt->bindParam(':partner', $versionData['partner'], PDO::PARAM_STR);

            // Handle doc_privado
            $docPrivado = $versionData['doc_privado'] ?? 0;
            $stmt->bindParam(':privado', $docPrivado, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            }

            return false;
        } catch (PDOException $e) {
            error_log("Error creating documento version: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update doc_version_actual in documento adjunto
     * 
     * @param int $docId Document adjunto ID
     * @param int $versionId Version ID
     * @return bool Success status
     */
    public function updateVersionActual($docId, $versionId)
    {
        try {
            $sql = "UPDATE trd_general_documento_adjunto 
                    SET doc_version_actual = :version_id 
                    WHERE doc_id = :doc_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':version_id', $versionId, PDO::PARAM_INT);
            $stmt->bindParam(':doc_id', $docId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating version actual: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save file to database (orchestrates all DB operations)
     * 
     * @param int $tramiteId Tramite ID
     * @param array $fileData File data (filename, original_name, encrypted_name)
     * @param int $userId User ID who uploaded the file
     * @return array [success, doc_id, version_id, error]
     */
    public function saveFileToDatabase($tramiteId, $fileData, $userId)
    {
        $startedTransaction = false;
        try {
            // Check if transaction is already active
            if (!$this->conn->inTransaction()) {
                $this->conn->beginTransaction();
                $startedTransaction = true;
            }

            // Disable FK checks to allow circular dependency insertion
            $this->conn->exec("SET FOREIGN_KEY_CHECKS=0");

            // 1. Create documento adjunto record
            $docId = $this->createDocumentoAdjunto($tramiteId);
            if ($docId === false) {
                $this->conn->exec("SET FOREIGN_KEY_CHECKS=1"); // Ensure re-enabled
                if ($startedTransaction)
                    $this->conn->rollBack();
                return [false, null, null, "Error al crear registro de documento"];
            }

            // 2. Prepare version data
            $currentMonth = date('Ym');

            // Get the actual .ck filename being used
            $ckFilename = $this->getCkFilename();
            if ($ckFilename === false) {
                $ckFilename = '.ck'; // Fallback to default
            }

            $versionData = [
                'enlace' => "gestordocumental/{$currentMonth}/{$fileData['encrypted_name']}",
                'nombre' => $fileData['original_name'],
                'responsable' => $userId,
                'docdigital' => false,
                'partner' => "{$currentMonth}/{$ckFilename}",
                'doc_privado' => $fileData['doc_privado'] ?? 0
            ];

            // 3. Create version record
            $versionId = $this->createDocumentoVersion($docId, $versionData);
            if ($versionId === false) {
                $this->conn->exec("SET FOREIGN_KEY_CHECKS=1"); // Ensure re-enabled
                if ($startedTransaction)
                    $this->conn->rollBack();
                return [false, null, null, "Error al crear registro de versión"];
            }

            // 4. Update version actual
            if (!$this->updateVersionActual($docId, $versionId)) {
                $this->conn->exec("SET FOREIGN_KEY_CHECKS=1"); // Ensure re-enabled
                if ($startedTransaction)
                    $this->conn->rollBack();
                return [false, null, null, "Error al actualizar versión actual"];
            }

            // Re-enable FK checks
            $this->conn->exec("SET FOREIGN_KEY_CHECKS=1");

            // Commit transaction if we started it
            if ($startedTransaction) {
                $this->conn->commit();
            }

            return [true, $docId, $versionId, null];
        } catch (\Exception $e) {
            // Ensure FK checks are re-enabled
            try {
                $this->conn->exec("SET FOREIGN_KEY_CHECKS=1");
            } catch (\Exception $ignore) {
            }

            if ($startedTransaction && $this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Error in saveFileToDatabase: " . $e->getMessage());
            return [false, null, null, $e->getMessage()];
        }
    }

    /**
     * Get document version by version ID
     * 
     * @param int $versionId Version ID
     * @return array|false Version data or false on failure
     */
    public function getDocumentoVersionById($versionId)
    {
        try {
            $sql = "SELECT docv_id, docv_doc_id, doc_fecha, doc_enlace_documento, 
                           doc_nombre_documento, `doc-responsable`, doc_docdigital, doc_partner
                    FROM trd_general_documento_adjunto_versiones
                    WHERE docv_id = :version_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':version_id', $versionId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting document version: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get latest version of a document by doc_id
     * 
     * @param int $docId Document ID
     * @return array|false Latest version data or false on failure
     */
    public function getLatestDocumentoVersion($docId)
    {
        try {
            $sql = "SELECT docv_id, docv_doc_id, doc_fecha, doc_enlace_documento, 
                           doc_nombre_documento, `doc-responsable`, doc_docdigital, doc_partner, doc_privado
                    FROM trd_general_documento_adjunto_versiones
                    WHERE docv_doc_id = :doc_id
                    ORDER BY doc_fecha DESC
                    LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':doc_id', $docId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting latest document version: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get encryption key from specific .ck file
     * 
     * @param string $ckPath Path to .ck file (e.g., "202602/halulu.ck")
     * @return string|false Encryption key or false on failure
     */
    public function getKeyFromCkFile($ckPath)
    {
        try {
            $fullPath = $this->uploadsBasePath . $ckPath;

            if (!file_exists($fullPath)) {
                error_log("CK file not found: " . $fullPath);
                return false;
            }

            $content = file_get_contents($fullPath);
            if ($content === false) {
                return false;
            }

            // Parse the file content
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }

                // Parse format: [KEY]:value
                if (preg_match('/^\[([^\]]+)\]:(.*)$/', $line, $matches)) {
                    $key = trim($matches[1]);
                    $value = trim($matches[2]);

                    if ($key === 'CLAVE') {
                        return $value;
                    }
                }
            }

            return false;
        } catch (\Exception $e) {
            error_log("Error reading key from CK file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get encrypted file content
     * 
     * @param string $filePath Path to encrypted file (e.g., "gestordocumental/202602/file.imv")
     * @return string|false Encrypted content or false on failure
     */
    public function getEncryptedFileContent($filePath)
    {
        try {
            $fullPath = $this->uploadsBasePath . '../' . $filePath;

            if (!file_exists($fullPath)) {
                error_log("Encrypted file not found: " . $fullPath);
                return false;
            }

            return file_get_contents($fullPath);
        } catch (\Exception $e) {
            error_log("Error reading encrypted file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all versions of a document
     * 
     * @param int $docId Document ID
     * @return array|false Array of versions or false on failure
     */
    public function getAllDocumentoVersions($docId)
    {
        try {
            $sql = "SELECT docv_id, docv_doc_id, doc_fecha, doc_enlace_documento, 
                           doc_nombre_documento, `doc-responsable`, doc_docdigital, doc_partner, doc_privado
                    FROM trd_general_documento_adjunto_versiones
                    WHERE docv_doc_id = :doc_id
                    ORDER BY doc_fecha DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':doc_id', $docId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting all document versions: " . $e->getMessage());
            return false;
        }
    }

    /**
     * ⚠️ WARNING: DESTRUCTIVE OPERATION - Delete document and all versions
     * 
     * This method permanently deletes:
     * imv => ilustr municipalidad de viña
     * - All physical .imv files from the server
     * - All version records from trd_general_documento_adjunto_versiones
     * - The document record from trd_general_documento_adjunto
     * 
     * ⚠️ DO NOT USE IN OTHER WORKFLOWS - This is specifically for GesDoc deletion only
     * ⚠️ THIS ACTION CANNOT BE UNDONE
     * 
     * @param int $docId Document ID to delete
     * @return array [success, message, deleted_files_count]
     */
    public function deleteDocumento($docId)
    {
        try {
            // Start transaction
            $this->conn->beginTransaction();

            // 1. Get all versions to delete physical files
            $versions = $this->getAllDocumentoVersions($docId);
            if ($versions === false) {
                $this->conn->rollBack();
                return [false, "Error al obtener versiones del documento", 0];
            }

            if (empty($versions)) {
                $this->conn->rollBack();
                return [false, "Documento no encontrado", 0];
            }

            // 2. Delete physical files
            $deletedFilesCount = 0;
            $fileErrors = [];

            foreach ($versions as $version) {
                $filePath = $this->uploadsBasePath . '../' . $version['doc_enlace_documento'];

                if (file_exists($filePath)) {
                    if (unlink($filePath)) {
                        $deletedFilesCount++;
                    } else {
                        $fileErrors[] = "No se pudo eliminar: " . $version['doc_enlace_documento'];
                    }
                }
            }

            // 3. Delete version records from database
            $sqlVersions = "DELETE FROM trd_general_documento_adjunto_versiones 
                           WHERE docv_doc_id = :doc_id";

            $stmtVersions = $this->conn->prepare($sqlVersions);
            $stmtVersions->bindParam(':doc_id', $docId, PDO::PARAM_INT);

            if (!$stmtVersions->execute()) {
                $this->conn->rollBack();
                return [false, "Error al eliminar registros de versiones", $deletedFilesCount];
            }

            // 4. Delete document record from database
            $sqlDoc = "DELETE FROM trd_general_documento_adjunto 
                      WHERE doc_id = :doc_id";

            $stmtDoc = $this->conn->prepare($sqlDoc);
            $stmtDoc->bindParam(':doc_id', $docId, PDO::PARAM_INT);

            if (!$stmtDoc->execute()) {
                $this->conn->rollBack();
                return [false, "Error al eliminar registro de documento", $deletedFilesCount];
            }

            // Commit transaction
            $this->conn->commit();

            $message = "Documento eliminado correctamente. Archivos físicos eliminados: " . $deletedFilesCount;
            if (!empty($fileErrors)) {
                $message .= ". Advertencias: " . implode(", ", $fileErrors);
            }

            return [true, $message, $deletedFilesCount];

        } catch (\Exception $e) {
            $this->conn->rollBack();
            error_log("Error in deleteDocumento: " . $e->getMessage());
            return [false, "Error del servidor: " . $e->getMessage(), 0];
        }
    }

    /**
     * Get all documents for a tramite
     * 
     * @param int $tramiteId Tramite ID
     * @return array|false Array of documents with latest version info or false on failure
     */
    public function getDocumentosByTramite($tramiteId)
    {
        try {
            $sql = "SELECT 
                        da.doc_id,
                        da.doc_tramite_registrado,
                        da.doc_fecha,
                        da.doc_version_actual,
                        dv.docv_id,
                        dv.doc_fecha as version_fecha,
                        dv.doc_enlace_documento,
                        dv.doc_nombre_documento,
                        dv.`doc-responsable`,
                        dv.doc_docdigital,
                        dv.doc_partner,
                        dv.doc_privado
                    FROM trd_general_documento_adjunto da
                    LEFT JOIN trd_general_documento_adjunto_versiones dv 
                        ON da.doc_version_actual = dv.docv_id
                    WHERE da.doc_tramite_registrado = :tramite_id
                    ORDER BY da.doc_fecha DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tramite_id', $tramiteId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting documents by tramite: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save file metadata to database
     * 
     * @param int $versionId Version ID
     * @param array $metadata Metadata array with keys: file_size, mime_type, extension, hash, origin_system, upload_date, user_id
     * @return bool Success status
     */
    public function saveFileMetadata($versionId, $metadata)
    {
        try {
            $metadataMap = [
                'file_size' => 'Tamaño',
                'mime_type' => 'Tipo MIME',
                'extension' => 'Extensión',
                'hash' => 'Hash SHA256',
                'origin_system' => 'Sistema Origen',
                'upload_date' => 'Fecha Subida',
                'user_id' => 'Usuario'
            ];

            foreach ($metadataMap as $key => $label) {
                if (isset($metadata[$key])) {
                    $sql = "INSERT INTO trd_documentos_metadata (tdm_documento, tdm_dato, tdm_valor) 
                           VALUES (:version_id, :dato, :valor)";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':version_id', $versionId, PDO::PARAM_INT);
                    $stmt->bindParam(':dato', $label, PDO::PARAM_STR);
                    $stmt->bindParam(':valor', $metadata[$key], PDO::PARAM_STR);

                    if (!$stmt->execute()) {
                        error_log("Error saving metadata {$label}: " . implode(", ", $stmt->errorInfo()));
                    }
                }
            }

            return true;
        } catch (PDOException $e) {
            error_log("Error saving file metadata: " . $e->getMessage());
            return false;
        }
    }
}

