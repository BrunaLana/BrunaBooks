<?php
require_once '../Controllers/CarrinhoController.php';
require_once '../Models/Livro.php'; // Assuming you have a Livro model for book operations

$alertMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $action = $_POST['action'];

    // Check available quantity using the Livro model
    $livro = Livro::find($productId);
    if ($livro) {
        $availableQuantity = $livro->ProductQtt;
        $currentQuantity = array_count_values($_SESSION['cart'])[$productId] ?? 0;

        if ($action === 'increase') {
            if ($currentQuantity < $availableQuantity) {
                $_SESSION['cart'][] = $productId;
            } else {
                $_SESSION['alertMessage'] = 'Quantidade indisponível para o produto: ' . htmlspecialchars($livro->productName);
            }
        } elseif ($action === 'decrease') {
            $key = array_search($productId, $_SESSION['cart']);
            if ($key !== false) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
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
    $itemsQtd = array_count_values($_SESSION['cart']);
    $items = GetItemsCarrinho();
    usort($items, function($a, $b) {
        return $a->productId - $b->productId;
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
                <span id="quantity-<?= $item->productId ?>"><?= $itemsQtd[$item->productId] ?></span>
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
</div>
<?php include '../Includes/contatoFooter.php'; ?>
<?php 

if (isset($_SESSION['alertMessage'])) :
    $alertMessage = $_SESSION['alertMessage'];
    unset($_SESSION['alertMessage']);

?>
<script> alert('<?= $alertMessage ?>'); </script>
<?php endif; ?>

</html>