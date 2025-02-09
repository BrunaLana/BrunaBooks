<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Order.php';

SessionHelper::startSession();

if (!SessionHelper::isLoggedIn() || $_SESSION['userrole'] !== 'admin') {
    $_SESSION['error_message'] = 'Acesso negado. Somente administradores podem acessar a página de gestão de pedidos!';
    header('Location: ../index.php');
    exit();
}

$orders = Order::getAllOrders();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../Includes/header.php'; ?>
    <link rel="stylesheet" href="../Styles/orders.css">
    <title>Gestão de Pedidos</title>
</head>

<body>
    <div class="container mt-8">
        <h2 class="titulo">Gestão de Pedidos</h2>
        <?php if (empty($orders)): ?>
            <p>Não há pedidos para exibir.</p>
        <?php else: ?>
            <table class="table table-striped">
            <thead>
            <tr>
            <th>Pedido ID</th>
            <th>Data da Encomenda</th>
            <th>Status da Encomenda</th>
            <th>Itens</th>
            <th>Total</th>
            <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td class="align-middle"><?= htmlspecialchars($order->encomendaId) ?></td>
                <td class="align-middle"><?= htmlspecialchars($order->dataEncomenda) ?></td>
                <td class="align-middle" <?= $order->statusId == '3' ? 'style="color:red !important;"' : '' ?>><?= htmlspecialchars($order->status) ?></td>
                <td class="align-middle"><?= htmlspecialchars($order->productQtt)?></td>
                <td class="align-middle"><?= htmlspecialchars($order->totalOrderPrice)?>€</td>
                <td class="align-middle">
                <form action="../Controllers/OrderController.php" method="post">
                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order->encomendaId) ?>">
                <div class="d-flex">
                    <select name="status" class="form-control texto-campos mr-2" style="max-width: 150px;margin-right:  10px !important;">
                        <option value="1" <?= $order->statusId == '1' ? 'selected' : '' ?>>Aguardando envio</option>
                        <option value="2" <?= $order->statusId == '2' ? 'selected' : '' ?>>Enviado</option>
                        <option value="3" <?= $order->statusId == '3' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                    <button type="submit" class="btn botao-confirm" name="update_status">Atualizar Status</button>
                </div>
                </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php include "../includes/contatoFooter.php"; ?>
</body>

</html>
