<?php
include('../Controllers/CarrinhoController.php');
?>
<!DOCTYPE html>
<html>
    <?php include 'Includes/header.php'; ?>
    <hr />

    <h1 class="carrinhoTitulo">Carrinho</h1>
    <?php
    $itemsQtd = array_count_values($_SESSION['cart']);
    $items = GetItemsCarrinho();
    foreach ($items as $item):
    ?>
        <div class="row mt-1 ps-4 pe-4">
            <div class="col-sm-1 px-3 my-3 text-center d-flex align-items-center"><img src="<?php echo 'data:image/jpeg;base64,' . $item['productImg']; ?>" width="100" height="120" alt="..."></div>
            <div class="col-sm-9 px-3 mb-1 d-flex align-items-center"><?php echo $item['productName']; ?></div>
            <div class="col-sm-1 px-3 mb-1 text-end d-flex align-items-center"><?php echo $item['productPrice']; ?></div>
            <div class="col-sm-1 px-3 mb-1 text-center d-flex align-items-center"><?php echo $itemsQtd[$item['productId']]; ?></div>
        </div>
    <?php endforeach; ?>
    <div class="row mt-1 d-flex justify-content-end pe-5 align-items-center">
        <span class="text-end me-5 mb-3">Total: <?php echo CalculaTotal(); ?></span>
    </div>
    <div class="botoesCarrinho">
        <button type="submit" class="botaoComprar">Finalizar Compra</button>
        <button type="submit" class="botaoContinuar">Continuar Comprando</button>
    </div>
</body>
<hr />
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

</html>