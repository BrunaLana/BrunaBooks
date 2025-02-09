<?php
require_once '../Helpers/SessionHelper.php';

SessionHelper::startSession();

// Check if the user has just completed a checkout
/*if (!isset($_SESSION['checkout_success']) || !$_SESSION['checkout_success']) {
    header('Location: livros.php');
    exit();
}

// Unset the checkout success flag
unset($_SESSION['checkout_success']);*/
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/pedidoSucesso.css">

<div class="container pedido-sucesso-container">
    <h2 class="titulo">Pedido Realizado com Sucesso!</h2>
    <p>Obrigado por sua compra. Seu pedido foi realizado com sucesso.</p>
    <div class="botoesPedidoSucesso">
        <a href="livros.php" class="btn botao-confirm">Continuar Comprando</a>
        <a href="meusPedidos.php" class="btn botao-confirm">Ver Meus Pedidos</a>
    </div>
</div>
<?php include '../Includes/contatoFooter.php'; ?>
</html>
