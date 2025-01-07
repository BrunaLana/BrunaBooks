<?php 
include('../Controllers/CarrinhoController.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrinho</title>
</head>
<body>
    <h1>Carrinho</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $itemsQtd= array_count_values($_SESSION['cart']);
                $items = GetItemsCarrinho();
             foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['productName']; ?></td>
                    <td><?php echo $item['productPrice']; ?></td>
                    <td><?php echo $itemsQtd[$item['productId']]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Total: <?php echo $total; ?></p>
</body>
</html>