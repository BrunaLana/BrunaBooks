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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device width, initial-scale=1.0">
    <title>BrunaBooks</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <?php include 'Includes/header.php'; ?>
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