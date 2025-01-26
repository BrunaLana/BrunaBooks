<?php

require_once '../conn.php';

class Livro
{

    public $productId;
    public $productName;
    public $productDesc;
    public $productImg;
    public $productPrice;
    public $ProductQtt;
    public $isActive;

    public static function getAllLivros()
    {

        $conn = getDatabaseConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_products");
        $stmt->execute();
        $result = $stmt->get_result();
        $livros = [];

        while ($row = $result->fetch_assoc()) {
            $livro = new Livro();
            $livro->productId = $row['productId'];
            $livro->productName = $row['productName'];
            $livro->productDesc = $row['productDesc'];
            $livro->productImg = $row['productImg'];
            $livro->productPrice = $row['productPrice'];
            $livro->ProductQtt = $row['ProductQtt'];
            $livro->isActive = $row['isActive'];
            $livros[] = $livro;
        }

        $stmt->close();
        closeConnection($conn);
        return $livros;
    }

    public static function getLivroById($id)
    {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE productId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            closeConnection($conn);
            return null;
        }

        $livro_data = $result->fetch_assoc();
        $livro = new Livro();
        $livro->productId = $livro_data['productId'];
        $livro->productName = $livro_data['productName'];
        $livro->productDesc = $livro_data['productDesc'];
        $livro->productImg = $livro_data['productImg'];
        $livro->productPrice = $livro_data['productPrice'];
        $livro->ProductQtt = $livro_data['ProductQtt'];
        $livro->isActive = $livro_data['isActive'];

        $stmt->close();
        closeConnection($conn);
        return $livro;
    }
}
