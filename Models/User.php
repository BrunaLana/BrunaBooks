<?php

require_once '../conn.php';

class User {
    public $id;
    public $username;
    public $password;
    public $userrole;

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
            $user->password = $user_data['userSenha']; // Corrected field name
            $user->userrole = $user_data['userRole'];
            $stmt->close();
            closeConnection($conn);
            return $user;
        } else {
            $stmt->close();
            closeConnection($conn);
            return null;
        }
    }
}
?>