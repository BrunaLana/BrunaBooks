<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Controllers/CarrinhoController.php';
require_once '../Models/Livro.php';

SessionHelper::startSession();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$alertMessage = '';
if (isset($_GET['addCart'])) {
    $productId = $_GET['addCart'];
    $action = 'increase';
    handleCarrinhoAction($productId, $action);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<style>
</style>
<section class="">
    <div class="row row-cols-1 row-cols-md-4 g-5">
        <?php
        $livros = Livro::getAllLivros();
        foreach ($livros as $livro): ?>
            <div class="col">
                <div class="card">
                    <img src="data:image/jpeg;base64,<?= $livro->productImg ?>" class="card-img-top" alt="Imagem do livro">
                    <?php if ($livro->ProductQtt <= 0): ?>
                        <div class="watermark"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.5); display: flex; justify-content: center; align-items: center;">
                            <span style="color: red; font-size: 24px; font-weight: bold;">Indisponível</span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($livro->productName) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($livro->productDesc) ?></p>
                        <a href="livroDetalhe.php?id=<?= $livro->productId ?>" class="btn botao-confirm">Ver Detalhes</a>
                    </div>
                    <div class="card-footer">
                        <b><small class="text-muted"><?= htmlspecialchars($livro->productPrice) ?>€</small></b>
                        <br />
                        <span style="float: right;">
                            <?php if ($livro->ProductQtt > 0): ?>
                                <a href="<?= $_SERVER['PHP_SELF'] ?>?addCart=<?= $livro->productId ?>" class="btn botao">
                                    Adicionar a sacola <img src="../Icons/add.svg" alt="Carrinho de compra"
                                        class="container__imagem" width="50px" height="50px">
                                </a>
                            <?php else: ?>
                                <a href="" class="btn botao-danger"><span class="indisponivel">Indisponível</span></a>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include '../Includes/contatoFooter.php';
if (isset($_SESSION['alertMessage'])):
    $alertMessage = $_SESSION['alertMessage'];
    unset($_SESSION['alertMessage']);

    ?>
    <script>
        alert('<?= $alertMessage ?>');
    </script>
<?php endif; ?>

</html>