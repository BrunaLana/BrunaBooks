<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Livro.php';

SessionHelper::startSession();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['addCart'])) {
    $_SESSION['cart'][] = $_GET['addCart'];
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<hr />
<section class="">
    <div class="row row-cols-1 row-cols-md-4 g-5">
        <?php
        $livros = Livro::getAllLivros();
        foreach ($livros as $livro): ?>
            <div class="col">
                <div class="card">
                    <img src="data:image/jpeg;base64,<?= $livro->productImg ?>" class="card-img-top" alt="Imagem do livro">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($livro->productName) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($livro->productDesc) ?></p>
                        <a href="livroDetalhe.php?id=<?= $livro->productId ?>" class="btn botao-confirm">Ver Detalhes</a>
                    </div>
                    <div class="card-footer">
                        <b><small class="text-muted"><?= htmlspecialchars($livro->productPrice) ?>€</small></b>
                        <span style="float:right;">
                            Adicionar a sacola
                            <a href="<?= $_SERVER['PHP_SELF'] ?>?addCart=<?= $livro->productId ?>" class="botao">
                                <img src="../Icons/add.svg" alt="Carrinho de compra" class="container__imagem" width="50px" height="50px">
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
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
</body>

</html>