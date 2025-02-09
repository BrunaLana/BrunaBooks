<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Livro.php';

SessionHelper::startSession();

function GetItemsCarrinho()
{
    $items = [];
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $livro = Livro::getLivroById($id);
            if ($livro) {
                $livro->ProductQtt = $quantity;
                $items[] = $livro;
            }
        }
    }
    return $items;
}

function CalculaTotal()
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $livro = Livro::getLivroById($id);
            if ($livro) {
                $total += $livro->productPrice * $quantity;
            }
        }
    }
    return $total;
}

function handleCarrinhoAction($productId, $action)
{
    $livro = Livro::find($productId);
    if ($livro) {
        $availableQuantity = $livro->ProductQtt;
        $currentQuantity = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] : 0;

        if ($action === 'increase') {
            if ($currentQuantity < $availableQuantity) {
                $_SESSION['cart'][$productId] = $currentQuantity + 1;
            } else {
                $_SESSION['alertMessage'] = 'Quantidade indisponível para o produto: ' . htmlspecialchars($livro->productName);
            }
        } elseif ($action === 'decrease') {
            if ($currentQuantity > 0) {
                $_SESSION['cart'][$productId] = $currentQuantity - 1;
                if ($_SESSION['cart'][$productId] == 0) {
                    unset($_SESSION['cart'][$productId]);
                }
            }
        }
    }
}

if (isset($_GET['remove'])) {
    $idToRemove = $_GET['remove'];
    if (isset($_SESSION['cart'][$idToRemove])) {
        unset($_SESSION['cart'][$idToRemove]);
    }
    header('Location: ../Views/carrinho.php');
    exit();
}
?>
