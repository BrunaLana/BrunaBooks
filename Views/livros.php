<?php
include('../controllers/livrosController.php');

if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
if (isset($_GET['addCart'])) {
	$_SESSION['cart'][] = $_GET['addCart'];
	header('location: ' . $_SERVER['PHP_SELF'] . '?' . SID);
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
            $books = getAll();
            while ($book = $books->fetch_assoc()):
                echo  '<div class="col">
                            <div class="card">
                                <img src="data:image/jpeg;base64,' . $book['productImg'] . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $book['productName'] . '</h5>
                                    <p class="card-text">' . $book['productDesc'] . '</p>
                                </div>
                                <div class="card-footer">
                                    <b><small class="text-muted">' . $book['productPrice'] . '€</small></b>
                                    <span style="float:right;">Adicionar a sacola 
                                    <a href="' . $_SERVER['PHP_SELF'] . '?addCart=' . $book['productId'] . '" class="botao">
                                    <img src="../Icons/add.svg" alt="Carrinho de compra" class="container__imagem" width="50px" height="50px"></span>
                                    </a>
                                </div>
                            </div>
                        </div>';
            endwhile;
            ?>
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