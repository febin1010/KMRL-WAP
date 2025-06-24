<?php
require_once '../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/WapController.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            $auth = new AuthController();
            $auth->login();
            break;

        case 'submit_wap':
        require_once '../controllers/WapController.php';
        $controller = new WapController();
        $controller->submitWapForm();
        break;



        // You can add other cases later: logout, register, etc.
        default:
            echo "Invalid action.";
    }
}
