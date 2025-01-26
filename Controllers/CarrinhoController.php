<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Livro.php';

SessionHelper::startSession();

function GetItemsCarrinho() {
    $items = [];
    if (isset($_SESSION['cart'])) {
        $ids = array_unique($_SESSION['cart']);
        foreach ($ids as $id) {
            $items[] = Livro::getLivroById($id);
        }
    }
    return $items;
}

function CalculaTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id) {
            $livro = Livro::getLivroById($id);
            $total += $livro->productPrice;
        }
    }
    return $total;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add' && isset($_POST['id'])) {
        $_SESSION['cart'][] = $_POST['id'];
        header('Location: ../Views/carrinho.php');
        exit();
    }
}

if (isset($_GET['remove'])) {
    $idToRemove = $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($id) use ($idToRemove) {
        return $id != $idToRemove;
    });
    header('Location: ../Views/carrinho.php');
    exit();
}
?>