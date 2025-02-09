<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Livro.php';
require_once '../Controllers/CarrinhoController.php';

SessionHelper::startSession();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $action = $_POST['action'];
    handleCarrinhoAction($productId, $action);
    header('Location: livroDetalhe.php?id=' . $productId);
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: livros.php');
    exit();
}

$livro = Livro::getLivroById($_GET['id']);
if (!$livro) {
    header('Location: livros.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../Includes/header.php'; ?>
<style>
    .livro-detalhes {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        /* Centraliza o conteúdo */
    }

    .livro-detalhes img {
        max-width: 50%;
        height: auto;
        margin-bottom: 20px;
    }

    .livro-detalhes h2 {
        margin-bottom: 20px;
    }

    .livro-detalhes p {
        margin-bottom: 10px;
    }

    .preco-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .preco {
        font-size: 24px;
        color: #28a745;
        text-align: left;
        /* Alinha à esquerda */
    }

    .btn-voltar {
        text-align: left;
        /* Alinha à esquerda */
        display: inline-block;
        margin-bottom: 20px;
    }

    .btn-container {
        text-align: left;
        /* Alinha à esquerda */
    }
</style>
<div class="livro-detalhes">
    <img src="data:image/jpeg;base64,<?= $livro->productImg ?>" alt="Imagem do livro">
    <h2 class="titulo"><?= htmlspecialchars($livro->productName) ?></h2>
    <p><?= htmlspecialchars($livro->productDesc) ?></p>
    <div class="preco-container">
        <p class="preco"><?= htmlspecialchars($livro->productPrice) ?>€</p>
        <form method="post" style="display:inline;">
            <input type="hidden" name="action" value="increase">
            <input type="hidden" name="productId" value="<?= $livro->productId ?>">
            <button type="submit" class="btn botao-confirm">Adicionar ao Carrinho</button>
        </form>
    </div>
    <div class="btn-container">
        <a href="livros.php" class="btn botao-confirm btn-voltar">Voltar</a>
    </div>
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