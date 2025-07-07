<?php

function login() {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    // Dummy superadmin
    if ($email === 'superadmin@example.com' && $password === 'password123') {
        echo json_encode([
            "token" => "dummy-token-123",
            "message" => "Login successful"
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid credentials"]);
    }
}

function getCurrentUser() {
    echo json_encode([
        "id" => 1,
        "name" => "Super Admin",
        "email" => "superadmin@example.com"
    ]);
}

function checkToken() {
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!str_starts_with($authHeader, 'Bearer dummy-token-123')) {
        http_response_code(401);
        echo json_encode(["message" => "Unauthorized"]);
        exit;
    }
}
