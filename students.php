<?php
require_once 'db.php';

function getAllStudents() {
    global $conn;

    $stmt = $conn->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students);
}

function getStudentById($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        echo json_encode($student);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Student not found"]);
    }
}

function createStudent() {
    global $conn;

    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $nim = $input['nim'] ?? '';
    $jurusan = $input['jurusan'] ?? '';

    if (!$name || !$email || !$nim || !$jurusan) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO students (name, email, nim, jurusan) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $nim, $jurusan])) {
        echo json_encode(["message" => "Student created successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to create student"]);
    }
}

function updateStudent($id) {
    global $conn;

    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $nim = $input['nim'] ?? '';
    $jurusan = $input['jurusan'] ?? '';

    if (!$name || !$email || !$nim || !$jurusan) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, nim=?, jurusan=? WHERE id=?");
    if ($stmt->execute([$name, $email, $nim, $jurusan, $id])) {
        echo json_encode(["message" => "Student updated successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to update student"]);
    }
}

function deleteStudent($id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    if ($stmt->execute([$id])) {
        echo json_encode(["message" => "Student deleted successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to delete student"]);
    }
}
