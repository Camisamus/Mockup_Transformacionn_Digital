<?php
// Mock session
session_start();
$_SESSION['user_id'] = 1; // Assuming there is a user with ID 1 for testing

require_once __DIR__ . '/backend/vendor/autoload.php';

use App\Config\Database;
use App\Controllers\AuthController;

$database = new Database();
$db = $database->getConnection();

$authController = new AuthController($db);

$permissions = $authController->isAuthenticated();

header("Content-Type: application/json");
if ($permissions !== false) {
    echo json_encode([
        'status' => 'success',
        'permissions' => $permissions
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Not authenticated or user 1 not found'
    ]);
}
