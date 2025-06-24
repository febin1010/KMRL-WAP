<?php
require_once '../config/db_connection.php';
require_once '../models/User.php';

class AuthController {
    public function login() {
        session_start();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

        if ($user && password_verify($password, trim($user['password']))) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    $redirectUrl = '../../views/admin/dashboard/dashboard.php';
                    break;
                case 'civil':
                    $redirectUrl = '../../views/civil/pending_waps.php';
                    break;
                case 'ctr':
                    $redirectUrl = '../../views/ctr/pending_waps.php';
                    break;
                case 'subhead':
                    $redirectUrl = '../../views/subhead/pending_waps.php';
                    break;
                case 'sai':
                    $redirectUrl = '../../views/sai/final_approval.php';
                    break;
                case 'safety':
                    $redirectUrl = '../../views/safety/review_forwarded.php';
                    break;
                default:
                    $redirectUrl = '../../views/auth/login.php';
                    break;
            }

            echo json_encode([
                'success' => true,
                'redirect' => $redirectUrl
            ]);
        }
        } else {    
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials',
                'email' => $email,
                'fetched_user' => $user
            ]);
        }
    }
}
