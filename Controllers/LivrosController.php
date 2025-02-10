<?php

require_once '../conn.php';
require_once '../Models/Livro.php';
require_once '../Helpers/SessionHelper.php';

SessionHelper::startSession();
class LivrosController
{
    public static function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo'];
            $descricao = $_POST["descricao"];
            $preco = floatval($_POST["preco"]);
            $imagem = base64_encode(file_get_contents($_FILES["imagem"]['tmp_name']));
            $isActive = true;
            $productQtt = $_POST["quantidade"];

            $conn = getDatabaseConnection();

            $stmt = $conn->prepare("INSERT INTO tbl_products (productName, productDesc, productImg,productPrice,isActive, productQtt)  VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssdi", $titulo, $descricao, $imagem, $preco, $isActive, $productQtt);

            if ($stmt->execute()) {
                // Registration successful
                header('Location: ../views/livroCreate.php');
                exit();
            } else {
                // Registration failed
                $_SESSION['error_message'] = 'Erro ao realizar o registro do livro. Por favor, tente novamente.';
                require '../Views/livroCreate.php';
            }

            $stmt->close();
            closeConnection($conn);
        } else {
            require '../Views/livroCreate.php';
        }
    }

    public static function update() {}

    public static function delete()
    {
        // Implement the delete functionality here
    }
}
// Call the appropriate function based on the request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'update') {
    LivrosController::update();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    LivrosController::register();
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
    LivrosController::delete();
}
