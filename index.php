<?php
require_once 'conn.php';
session_start();
$conn = getDatabaseConnection();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device width, initial-scale=1.0">
    <title>BrunaBooks</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
            <img src="Icons/Logo.svg" alt="logo BrunaBooks" class="container__imagem">
            <h1 class="container__titulo"><b class="container__titulo--negrito">Bruna</b>Books</h1>
        </div>
        <ul class="opcoes">
            <input type="checkbox" id="opcoes-menu" class="opcoes__botao">
            <label for="opcoes-menu" class="opcoes__rotulo">
                <li class="opcoes__item">Livros</li>
            </label>
            <ul class="lista-menu">
                <li class="lista-menu__item"><a href="./Views/livros.php" class="lista-menu__link">Todos</a></li>
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
                        <li class="lista-menu__item"><a href="./views/livroCreate.php" class="lista-menu__link">Cadastro de Produto</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Gerir Usuário</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Gerir Pedidos</a></li>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Relatório de Vendas</a></li>
                    </ul>
                </ul>'
            ?>

        </ul>
        <div class="containers">
            <a href="#" class="container__link">
                <img src="Icons/Compras.svg" alt="Carrinho de compra" class="container__imagem">
                <p class="container__texto">Minha sacola</p>
            </a>
            <a href="#" class="container__link">
                <img src="Icons/Usuário.svg" alt="Meu perfil" class="container__imagem">
                <p class="container__texto">Meu perfil</p>
            </a>
        </div>
    </header>
    <section class="banner">
        <h2 class="banner__titulo">Já sabe por onde começar?</h2>
        <p class="banner__texto">Encontre em nossa estante o que precisa para seu desenvolvimento!</p>
        <input type="search" class="banner__pesquisa" placeholder="Qual será sua próxima leitura?">
    </section>

    <section class="carrossel">
        <h2 class="carrossel__titulo">Lançamentos</h2>
        <!-- Slider main container -->
        <div class="carrossel__container">
            <div class="swiper">
                <!-- Additional required wrapper -->
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    // colocar os slides do carrossel aqui com link para o produto
                    ?>
                    <div class="swiper-slide"><img src="images/bookAlgoritmos_.jpg" alt="Livro sobre Algoritmos"></div>
                    <div class="swiper-slide"><img src="images/bookJava_.jpg" alt="Livro sobre Java "></div>
                    <div class="swiper-slide"><img src="images/bookBig_.jpg" alt="Livro sobre Big Data"></div>
                    <div class="swiper-slide"><img src="images/bookHTML_.jpg" alt="Livro sobre HTML"></div>
                    <div class="swiper-slide"><img src="images/bookJava1_.jpg" alt="Livro sobre Java"></div>
                    <div class="swiper-slide"><img src="images/bookJavascript_.jpg" alt="Livro sobre Javascript"></div>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
            <div class="card">
                <!--1° linha-->
                <div class="card__descricao">
                    <!--1°coluna-->
                    <div class="descricao">
                        <h3 class="descricao__titulo">Talvez você também se interesse por...</h3>
                        <h2 class="descricao__titulo-livro">Angular 11 e Firebase</h2>
                        <p class="descricao__texto">Construindo uma aplicação integrada com a plataforma do Google.</p>
                    </div>
                    <!--2°coluna-->
                    <img src="images/Angular.svg" class="descricao__imagem">
                </div>

                <!--2°linha-->
                <div class="card__botoes">
                    <!--1°coluna-->
                    <ul class="botoes">
                        <li class="botoes__itens"><img src="Icons/Favoritos.svg" alt="favoritar livros"></li>
                        <li class="botoes__itens"><img src="Icons/Compras.svg" alt="adicionar no carrinho"></li>
                    </ul>
                    <!--2°<coluna-->
                    <a href="#" class="botoes__ancora">Saiba mais</a>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel">
        <h2 class="carrossel__titulo">Mais Vendidos</h2>
        <!-- Slider main container -->
        <div class="carrossel__container">
            <div class="swiper">
                <!-- Additional required wrapper -->
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide"><img src="images/bookJS_.jpg" alt="Livro sobre JS"></div>
                    <div class="swiper-slide"><img src="images/bookMysql_.jpg" alt="Livro sobre MYSQL"></div>
                    <div class="swiper-slide"><img src="images/bookPHP1_.jpg" alt="Livro sobre PHP"></div>
                    <div class="swiper-slide"><img src="images/bookPHP_.jpg" alt="Livro sobre PHP "></div>
                    <div class="swiper-slide"><img src="images/bookProgramador_.jpg" alt="Livro sobre  Programação"></div>
                    <div class="swiper-slide"><img src="images/bookPython1_.jpg" alt="Livro sobre Python "></div>
                </div>


                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
            <div class="card">
                <!--1° linha-->
                <div class="card__descricao">
                    <!--1°coluna-->
                    <div class="descricao">
                        <img src="images/Estrelinhas.png" alt="cinco estrelas amarelas">
                        <h3 class="descricao__titulo">Autora do Mês</h3>
                        <h2 class="descricao__titulo-livro">Joanne Rowling</h2>
                        <p class="descricao__texto">Analista de sistemas e escritora, Joanne é especialista em Front-End. </p>
                    </div>
                    <!--2°coluna-->
                    <img src="images/Perfil-escritora 1.svg" class="descricao__imagem">
                </div>

                <!--2°linha-->
                <div class="card__botoes">
                    <!--1°coluna-->
                    <ul class="botoes">
                        <li class="botoes__itens"><img src="Icons/Favoritos.svg" alt="favoritar livros"></li>
                        <li class="botoes__itens"><img src="Icons/Compras.svg" alt="adicionar no carrinho"></li>
                    </ul>
                    <!--2°<coluna-->
                    <a href="#" class="botoes__ancora">Saiba mais</a>
                </div>
            </div>
        </div>
    </section>

    <section class="topicos">
        <h2 class="topicos__titulo">TÓPICOS VISITADOS RECENTEMENTE</h2>
        <ul class="topicos__lista">
            <li class="topicos__item">
                <a href="#" class="topicos__link">Android</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">Marketing Digital</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">Agile</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">Startups</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">HTML & CSS</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">Python</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">PHP</a>
            </li>
            <li class="topicos__item">
                <a href="#" class="topicos__link">Java</a>
            </li>
        </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            spaceBetween: 10,
            slidesPerView: 3,
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
            },
        });
    </script>
</body>
<a href="../views/livros.php" class="botoesItens"><img src="imagens/iconUsuário.svg"
        alt="adicionar no carrinho"></a>

</html>