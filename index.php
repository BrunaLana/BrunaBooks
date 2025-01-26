<?php
require_once 'conn.php';
session_start();
$conn = getDatabaseConnection();

$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$LoggedOut = false;
if (isset($_SESSION['logged_out'])) {
    $LoggedOut = $_SESSION['logged_out'];
    unset($_SESSION['logged_out']);
}

if (!empty($error_message  && str_contains($error_message, 'Acesso negado'))) {
    echo '<script>alert("' . $error_message . '");</script>';
}
?>
<!DOCTYPE html>
<html>

<?php include 'Includes/rootHeader.php'; ?>
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

<?php
if ($LoggedOut) {
    echo '<script>alert("Logout realizado com sucesso!");</script>';
    $LoggedOut = false;
}
?>

</html>