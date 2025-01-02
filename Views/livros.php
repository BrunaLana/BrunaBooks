<?php
include('../controllers/livrosController.php');

if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
if (isset($_GET['addCart'])) {
	$_SESSION['carrinho'][] = $_GET['addCart'];
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
    <header class="cabecalho">
        <div class="containers">
            <input type="checkbox" id="menu" class="container__botao">
            <label for="menu" class="container__rotulo">
                <span class="cabecalho__menu-hamburguer container__imagem"></span>
            </label>
            <ul class="lista-menu">
                <li class="lista-menu__titulo">Livros</li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Home</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Todos</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Programação</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Redes</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Design & UX</a></li>
            </ul>
            <img src="../Icons/Logo.svg" alt="logo BrunaBooks" class="container__imagem">
            <h1 class="container__titulo"><b class="container__titulo--negrito">Bruna</b>Books</h1>
        </div>
        <ul class="opcoes">
            <input type="checkbox" id="opcoes-menu" class="opcoes__botao">
            <label for="opcoes-menu" class="opcoes__rotulo">
                <li class="opcoes__item">Livros</li>
            </label>
            <ul class="lista-menu">
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Todos</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Programação</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Redes</a></li>
                <li class="lista-menu__item"><a href="#" class="lista-menu__link">Design & UX</a></li>
            </ul>

            <li class="opcoes__item"><a href="#" class="opcoes__link">Home</a></li>
            <li class="opcoes__item"><a href="#" class="opcoes__link">Contato</a></li>
            <?php
            if (true)
                echo '<ul class="menu-admin">
                    <input type="checkbox" id="opcoes-menu-admin" class="opcoes__botao__admin">
                    <label for="opcoes-menu-admin" class="opcoes__rotulo__admin">
                        <li class="opcoes__item__admin">ADMIN</li>
                    </label>
                    <ul class="lista-menu-admin" style="z-index:9999;">
                        <li class="lista-menu__item"><a href="livrocreate.php" class="lista-menu__link">Cadastro de Produto</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Gerir Usuário</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Gerir Pedidos</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Relatório de Vendas</a></li>
                    </ul>
                </ul>'
            ?>

        </ul>
        <div class="containers">
            <a href="#" class="container__link">
                <img src="../Icons/Compras.svg" alt="Carrinho de compra" class="container__imagem">
                <p class="container__texto">Minha sacola</p>
            </a>
            <a href="#" class="container__link">
                <img src="../Icons/Usuário.svg" alt="Meu perfil" class="container__imagem">
                <p class="container__texto">Meu perfil</p>
            </a>
        </div>
    </header>
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