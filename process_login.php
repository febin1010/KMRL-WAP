<?php
session_start();
require 'db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = trim($_POST['email']); // Assuming email is the user_id
    $password = trim($_POST['password']);

    if (empty($user_id) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login.php");
        exit();
    }

    try {
        // Fetch the admin record by user_id (email)
        $stmt = $pdo->prepare("SELECT id, user_id, password FROM adminlogin WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and verify password
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['user_id'] = $admin['user_id'];

            header("Location: wapdashboard.html"); // Redirect to admin dashboard
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: waplogin.html");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        $_SESSION['error'] = "Something went wrong. Try again later.";
        header("Location: waplogin.html");
        exit();
    }
} else {
    header("Location: waplogin.html");
    exit();
}
?>
