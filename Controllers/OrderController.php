<?php
require_once '../Models/Order.php';
require_once '../Helpers/SessionHelper.php';

SessionHelper::startSession();

if (!SessionHelper::isLoggedIn() || $_SESSION['userrole'] !== 'admin') {
    $_SESSION['error_message'] = 'Acesso negado!';
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    Order::updateOrderStatus($orderId, $status);
    header('Location: ../Views/gestaoPedidos.php');
    exit();
}
?>
