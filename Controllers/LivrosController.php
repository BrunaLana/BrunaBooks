<?php
include('../conn.php');
session_start();
$conn = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    global $conn;

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $titulo = $_POST['titulo'];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $imagem = base64_encode(file_get_contents($_FILES["imagem"]['tmp_name']));
    
    createLivro($titulo, $descricao, $preco, $imagem);
}

function getAll()
{
    global $conn;
    $resultado = mysqli_query($conn, 'SELECT * FROM tbl_products');
    $conn -> close();
    return $resultado;
}

function createLivro($titulo, $descricao, $preco, $imagem)
{
    global $conn;
    $sql = "INSERT INTO tbl_products (productName, productDesc, productImg,productPrice,isActive) 
    VALUES ( '$titulo' ,'$descricao','$imagem', $preco, true)";

    if ($conn->query($sql) === TRUE) {
        echo  "<script>alert('O produto foi insertido com sucesso!');location.href='../views/livroCreate.php';</script>";
        exit();
    }

    $conn->close();
}

function updateLivro($id, $name, $description, $price, $image) {}

function getLivro($id) {}
