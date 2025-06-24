<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'civil') {
    header('Location: ../../auth/login.php');
    exit();
}
?>
