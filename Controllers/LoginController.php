<?php

require_once '../Models/User.php';
require_once '../Helpers/SessionHelper.php';

function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['user_name'];
        $password = $_POST['user_senha'];

        error_log("Attempting to find user by username: $username");

        $user = User::findByUsername($username);

        if ($user) {
            error_log("User found: " . $user->username);
            error_log(password_verify($password, $user->password));
            error_log(password_hash($password, PASSWORD_BCRYPT));
            error_log($password);
            Error_log($user->password);
        } else {
            error_log("User not found");
        }


        if ($user && password_verify($password, $user->password)) {
            error_log("Password verified for user: " . $user->username);
            SessionHelper::login($user);
            header('Location: ../index.php');
            exit();
        } else {
            error_log("Invalid username or password");
            $_SESSION['error_message'] =  'Invalid username or password';
            header('Location: ../Views/login.php');
            exit();
        }
    } else {
        require '../Views/login.php';
    }
}