<?php
// Konfigurasi database
$host = 'localhost';
$db   = 'student_api';
$user = 'root';
$pass = 'julyan123'; // sesuaikan pass MYSQL masing masing

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Database connection failed: " . $e->getMessage()]);
    exit;
}
?>
