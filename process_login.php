<?php
session_start();
require 'db_connection.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the request is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit();
}

// Get input values
$user_id = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($user_id) || empty($password)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, user_id, password FROM adminlogin WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['user_id'] = $admin['user_id'];

        echo json_encode(["success" => true, "redirect" => "wapdashboard.php"]);
        exit();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid USER-ID or password."]);
        exit();
    }
} catch (PDOException $e) {
    error_log("Login Error: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Something went wrong. Try again later."]);
    exit();
}
?>
