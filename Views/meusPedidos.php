<?php
// filepath: /c:/xampp/htdocs/BrunaBooks/Views/orders.php
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
</head>
<body>
    <svg 
    <div class="container pedidos-container">
        <h2 class="titulo">Meus Pedidos</h2>
        <?php if (empty($orders)): ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="pedido-item">
                    <h5>Pedido #<?= htmlspecialchars($order->id) ?></h5>
                    <p>Data: <?= htmlspecialchars($order->date) ?></p>
                    <p>Total: <?= htmlspecialchars($order->total) ?>€</p>
                    <a href="orderDetails.php?orderId=<?= $order->id ?>" class="btn btn-primary">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>