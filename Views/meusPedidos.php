<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Order.php';

SessionHelper::startSession();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$orders = Order::getOrdersByUserId($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../Includes/header.php'; ?>
    <link rel="stylesheet" href="../Styles/orders.css">
    <title>Meus Pedidos</title>

    <div class="container pedidos-container">
        <h2 class="titulo">Meus Pedidos</h2>
        <?php if (empty($orders)): ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="pedido-item">
                    <h2><b>Pedido #<?= htmlspecialchars($order->encomendaId) ?></b></h2>
                    <div style="display: flex; justify-content: space-between;">
                        <h5><b>Data da encomenda:</b> <?= htmlspecialchars($order->dataEncomenda) ?></h5>
                        <h5><b>Status da encomenda:</b> <span  <?= $order->statusId == '3' ? 'style="color:red !important;"><b' : '' ?>><?= htmlspecialchars($order->status) ?></b></span></h5>
                    </div>
                    <?php 
                    $orderItems = Order::getOrderitemsByOrderId($order->encomendaId);
                    foreach ($orderItems as $item): ?>
                        <div class="pedido-item">
                            <div class="pedido-item-img col-sm-2" style="display: inline-block; vertical-align: top;">
                                <img src="data:image/jpeg;base64,<?=$item->productImg ?>" alt="Imagem do produto">
                            </div>
                            <div class="pedido-item-info col-sm-9" style="display: inline-block;">
                                <p><b>Produto:</b> <?= htmlspecialchars($item->productName) ?></p>
                                <p><b>Preço:</b> <?= htmlspecialchars($item->productPrice) ?>€</p>
                                <p><b>Quantidade:</b> <?= htmlspecialchars($item->productQtt) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <h2 class='' >Total: <?= htmlspecialchars($order->totalOrderPrice) ?>€</h2>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php include "../includes/contatoFooter.php"; ?>

</html>