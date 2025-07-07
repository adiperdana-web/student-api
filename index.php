<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header("Content-Type: application/json");

require_once 'auth.php';
require_once 'students.php';

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/api/auth/login' && $method === 'POST') {
    login();
} elseif ($uri === '/api/auth/me' && $method === 'GET') {
    getCurrentUser();
} elseif ($uri === '/api/students' && $method === 'GET') {
    checkToken();
    getAllStudents();
} elseif (preg_match('#^/api/students/(\d+)$#', $uri, $matches)) {
    $id = $matches[1];
    if ($method === 'GET') {
        checkToken();
        getStudentById($id);
    } elseif ($method === 'PUT') {
        checkToken();
        updateStudent($id);
    } elseif ($method === 'DELETE') {
        checkToken();
        deleteStudent($id);
    } else {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }
} elseif ($uri === '/api/students' && $method === 'POST') {
    checkToken();
    createStudent();
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint not found"]);
}
