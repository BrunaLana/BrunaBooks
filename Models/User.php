<?php

require_once '../conn.php';

class User {
    public $id;
    public $username;
    public $password;
    public $userrole;
    public $email;
    public $nickname;
    public $apelido;
    public $dataNasc;

    public static function findByUsername($username) {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE userNickName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $user = new User();
            $user->id = $user_data['userId'];
            $user->username = $user_data['userNome'];
            $user->password = $user_data['userSenha'];
            $user->userrole = $user_data['userRole'];
            $user->email = $user_data['userEmail'];
            $user->nickname = $user_data['userNickName'];
            $user->apelido = $user_data['userApelido'];
            $user->dataNasc = $user_data['userDataNasc'];
            $stmt->close();
            closeConnection($conn);
            return $user;
        } else {
            $stmt->close();
            closeConnection($conn);
            return null;
        }
    }

    public static function getAllUsers() {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $user = new User();
            $user->id = $row['userId'];
            $user->username = $row['userNome'];
            $user->password = $row['userSenha'];
            $user->userrole = $row['userRole'];
            $user->email = $row['userEmail'];
            $user->nickname = $row['userNickName'];
            $user->apelido = $row['userApelido'];
            $user->dataNasc = $row['userDataNasc'];
            $users[] = $user;
        }

        $stmt->close();
        closeConnection($conn);
        return $users;
    }
}
?>