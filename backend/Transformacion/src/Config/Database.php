<?php

namespace App\Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct()
    {
        // Headers CORS removed from here to avoid duplication

        try {
            if (file_exists(__DIR__ . '/../../../.env') && class_exists('\\Dotenv\\Dotenv')) {
                $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
                $dotenv->load();
            }
        } catch (\Throwable $e) {
            // Silently fail if .env is missing or Dotenv is not available
        }

        $this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost';
        $this->db_name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'transformacion_digital_beta';
        $this->username = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'root';
        $this->password = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?: 'root';
    }

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8mb4");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            // Do not echo here as it breaks JSON responses
            error_log("Connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
