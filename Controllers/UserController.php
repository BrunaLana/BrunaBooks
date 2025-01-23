<?php

require_once '../conn.php';
require_once '../Models/User.php';

class UserController {
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $apelido = $_POST['apelido'];
            $email = $_POST['email'];
            $userNickName = $_POST['userNickName'];
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

            $conn = getDatabaseConnection();

            $stmt = $conn->prepare("INSERT INTO tbl_users (userNome, userNickName, userEmail, userSenha, userRole, userApelido) VALUES (?, ?, ?, ?, ?, ?)");
            $userRole = 'user'; // Default role
            $stmt->bind_param("ssssss", $nome, $userNickName, $email, $senha, $userRole, $apelido);

            if ($stmt->execute()) {
                // Registration successful
                header('Location: ../index.php');
                exit();
            } else {
                // Registration failed
                $error = 'Erro ao registrar usuário. Por favor, tente novamente.';
                require '../Views/registro.php';
            }

            $stmt->close();
            closeConnection($conn);
        } else {
            require '../Views/registro.php';
        }
    }
}

// Call the register function
UserController::register();
?>