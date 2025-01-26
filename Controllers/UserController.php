<?php

require_once '../conn.php';
require_once '../Models/User.php';

class UserController
{
    public static function register()
    {
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

    public static function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("DELETE FROM tbl_users WHERE userId = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Deletion successful
                header('Location: ../Views/userManagement.php');
                exit();
            } else {
                // Deletion failed
                $error = 'Erro ao excluir usuário. Por favor, tente novamente.';
                require '../Views/userManagement.php';
            }

            $stmt->close();
            closeConnection($conn);
        }
    }

    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $userrole = isset($_POST['isAdmin']) ? 'admin' : 'user';
            $nickname = $_POST['nickname'];
            $apelido = $_POST['apelido'];
            $dataNasc = $_POST['dataNasc'];

            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("UPDATE tbl_users SET userNome = ?, userEmail = ?, userRole = ?, userNickName = ?, userApelido = ?, userDataNasc = ? WHERE userId = ?");
            $stmt->bind_param("ssssssi", $username, $email, $userrole, $nickname, $apelido, $dataNasc, $id);

            if ($stmt->execute()) {
                // Update successful
                $_SESSION['userrole'] = $userrole;
                header('Location: ../Views/userManagement.php');
                exit();
            } else {
                // Update failed
                $error = 'Erro ao atualizar usuário. Por favor, tente novamente.';
                require '../Views/userManagement.php';
            }

            $stmt->close();
            closeConnection($conn);
        }
    }
}
// Call the appropriate function based on the request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'update') {
    UserController::update();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    UserController::register();
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
    UserController::delete();
}
