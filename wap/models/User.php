<?php
class User {
    public function getUserByEmail($email) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
