<?php

namespace App\Helpers;

class FileEncryption
{
    /**
     * Encrypt data using AES-256-CBC
     * 
     * @param string $data Data to encrypt
     * @param string $key Encryption key
     * @return string|false Encrypted data (base64 encoded) or false on failure
     */
    public static function encrypt($data, $key)
    {
        try {
            // Generate a random IV (Initialization Vector)
            $ivLength = openssl_cipher_iv_length('aes-256-cbc');
            $iv = openssl_random_pseudo_bytes($ivLength);

            // Hash the key to ensure it's the right length
            $keyHash = hash('sha256', $key, true);

            // Encrypt the data
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $keyHash, OPENSSL_RAW_DATA, $iv);

            if ($encrypted === false) {
                return false;
            }

            // Combine IV and encrypted data, then encode to base64
            $result = base64_encode($iv . $encrypted);

            return $result;
        } catch (\Exception $e) {
            error_log("Encryption error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Decrypt data using AES-256-CBC
     * 
     * @param string $encryptedData Encrypted data (base64 encoded)
     * @param string $key Decryption key
     * @return string|false Decrypted data or false on failure
     */
    public static function decrypt($encryptedData, $key)
    {
        try {
            // Decode from base64
            $data = base64_decode($encryptedData);

            if ($data === false) {
                return false;
            }

            // Extract IV and encrypted content
            $ivLength = openssl_cipher_iv_length('aes-256-cbc');
            $iv = substr($data, 0, $ivLength);
            $encrypted = substr($data, $ivLength);

            // Hash the key to ensure it's the right length
            $keyHash = hash('sha256', $key, true);

            // Decrypt the data
            $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $keyHash, OPENSSL_RAW_DATA, $iv);

            return $decrypted;
        } catch (\Exception $e) {
            error_log("Decryption error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate a random alphanumeric key
     * 
     * @param int $length Length of the key to generate
     * @return string Random key
     */
    public static function generateRandomKey($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomKey = '';

        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomKey;
    }

    /**
     * Generate a secure encryption key
     * 
     * @param int $length Length of the key (default 32 for AES-256)
     * @return string Random encryption key
     */
    public static function generateEncryptionKey($length = 32)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}
