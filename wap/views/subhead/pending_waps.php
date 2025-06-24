<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'subhead') {
    header('Location: ../../auth/login.php');
    exit();
}
?>
