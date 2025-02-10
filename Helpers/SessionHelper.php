<?php

class SessionHelper {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($user) {
        self::startSession();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['userrole'] = $user->userrole;
    }

    public static function logout() {
        self::startSession();
        $_SESSION['logged_out'] = true;
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['userrole']);
    }

    public static function isLoggedIn() {
        self::startSession();
        return isset($_SESSION['user_id']);
    }

    public static function getUser() {
        self::startSession();
        if (self::isLoggedIn()) {
            return (object) [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ];
        }
        return null;
    }
    public static function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
}
?>