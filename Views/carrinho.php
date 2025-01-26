<?php
require_once '../Controllers/CarrinhoController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../Includes/header.php'; ?>
    <link rel="stylesheet" href="../Styles/carrinho.css">

    <div class="container carrinho-container">
        <h2 class="titulo">Carrinho</h2>
        <?php
        $itemsQtd = array_count_values($_SESSION['cart']);
        $items = GetItemsCarrinho();
        foreach ($items as $item):
        ?>
            <div class="carrinho-item">
                <img src="data:image/jpeg;base64,<?= $item->productImg ?>" alt="Imagem do produto">
                <div class="item-info">
                    <h5><?= htmlspecialchars($item->productName) ?></h5>
                </div>
                <div class="item-price"><?= htmlspecialchars($item->productPrice) ?>€</div>
                <div class="item-quantity"><?= $itemsQtd[$item->productId] ?></div>
                <div class="item-remove">
                    <a href="carrinho.php?remove=<?= $item->productId ?>" class="btn btn-delete btn-xs" onclick="confirmDeletion(event, 'Tem certeza que deseja excluir todos os itens deste produto do seu carrinho?')">
                        <img src="../Icons/trash.svg" alt="Remover" class="container-removeIcon" width="50px" height="50px">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="total-container">
            <span>Total: <?= CalculaTotal() ?>€</span>
        </div>
        <div class="botoesCarrinho">
            <a href="livros.php" class="btn botao-delete">Finalizar Compra</a>
            &nbsp;&nbsp;
            <a href="livros.php" class="btn botao-confirm">Continuar Comprando</a>
        </div>
    </div>
    <section class="contato">
        <div class="contato__descricao">
            <h2 class="contato__titulo">Fique por dentro das novidades!</h2>
            <p class="contato__texto">Atualizações de e-books, novos livros, promoções e outros.</p>
        </div>
        <input type="email" placeholder="Cadastre seu e-mail" class="contato__email">
    </section>
    <hr />
    <footer class="rodape">
        <h2 class="rodape__titulo">Grupo B.LANA</h2>
    </footer>
    <script src="../Script/site.js"></script>
    </body>

</html>