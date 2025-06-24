<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ././auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WAP Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Optional: Alpine.js for interactivity if needed -->
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">

    <div id="app" class="flex min-h-screen">

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 bg-white overflow-y-auto p-6">
            <?php
                include 'pages/dashboard-main.php';
                include 'pages/create-wap.php';
                include 'pages/edit-wap.php';
                include 'pages/pending-wap.php';
                include 'pages/user-management.php';
            ?>
        </div>

    </div>

    <!-- Chart Logic -->
    <script src="includes/charts.js" type="module"></script>

    <!-- Section Toggle Script -->
    <script type="module">
        import { initializeCharts } from './includes/charts.js';

        function showPage(pageId) {
            document.querySelectorAll('.page').forEach(page => {
                page.classList.add('hidden');
            });

            const target = document.getElementById(pageId);
            if (target) {
                target.classList.remove('hidden');

                if (pageId === 'dashboard') {
                    initializeCharts(); // Call it safely only on dashboard
                }

                if (pageId === 'create-wap') {
                    if (typeof loadWapForm === 'function') {
                            loadWapForm();
                    }
                }
            }
        }

        // On DOM ready, show dashboard by default
        document.addEventListener('DOMContentLoaded', () => {
            showPage('dashboard');
        });

        // Optionally make showPage available globally if sidebar buttons use onclick
        window.showPage = showPage;
    </script>

</body>
</html>
