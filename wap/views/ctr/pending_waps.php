<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ctr') {
    header('Location: ../../auth/login.php');
    exit();
}
?>
