<?php
require_once '../Controllers/CarrinhoController.php';
require_once '../Models/Livro.php'; // Assuming you have a Livro model for book operations

$alertMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $action = $_POST['action'];
    handleCarrinhoAction($productId, $action);
    header('Location: carrinho.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/carrinho.css">

<div class="container carrinho-container">
    <h2 class="titulo">Carrinho</h2>


    <?php
    $items = GetItemsCarrinho();
    if (empty($items)) {
    ?>
        <div class="carrinho-vazio">
            <h3 class="titulo">Seu carrinho está vazio</h3>
            <div class="botoesCarrinho"><a href="livros.php" class="btn botao-confirm">Continuar Comprando</a></div>
        </div>
        <?php
    } else {
        usort($items, function ($a, $b) {
            return strcmp($a->productId, $b->productId);
        });
        foreach ($items as $item):
        ?>
            <div class="carrinho-item">
                <img src="data:image/jpeg;base64,<?= $item->productImg ?>" alt="Imagem do produto">
                <div class="item-info">
                    <h5><?= htmlspecialchars($item->productName) ?></h5>
                </div>
                <div class="item-price">
                    <h5 class="mb-0">Valor</h5><?= htmlspecialchars($item->productPrice) ?>€
                </div>
                <div class="item-quantity">
                    <h5 class="mb-0">Qtd.</h5>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="productId" value="<?= $item->productId ?>">
                        <input type="hidden" name="action" value="decrease">
                        <button type="submit" class="btn botao-confirm m-0 p-0" style="width:25px; height:25px;"><b>-</b></button>
                    </form>
                    <span id="quantity-<?= $item->productId ?>"><?= $item->ProductQtt ?></span>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="productId" value="<?= $item->productId ?>">
                        <input type="hidden" name="action" value="increase">
                        <button type="submit" class="btn botao-confirm m-0 p-0" style="width:25px; height:25px;"><b>+</b></button>
                    </form>
                </div>
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
            <a href="checkout.php" class="btn botao-delete">Finalizar Compra</a>
            &nbsp;&nbsp;
            <a href="livros.php" class="btn botao-confirm">Continuar Comprando</a>
        </div>

    <?php } ?>
</div>
<?php include '../Includes/contatoFooter.php';
if (isset($_SESSION['alertMessage'])) :
    $alertMessage = $_SESSION['alertMessage'];
    unset($_SESSION['alertMessage']);

?>
    <script>
        alert('<?= $alertMessage ?>');
    </script>
<?php endif; ?>

</html>