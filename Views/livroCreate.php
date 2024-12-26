<?php
include('../Controllers/LivrosController.php');
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
            <li class="lista-menu__item"><a href="livros.php" class="lista-menu__link">Todos</a></li>
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
                    <ul class="lista-menu-admin" style="z-index:9999;">>
                        <li class="lista-menu__item"><a href="#" class="lista-menu__link">Cadastro de Produto</a></li>
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

<body>
    <h1>Cadastro de Livro</h1>
    <section class="cadastro_Livros">
        <form action="../controllers/LivrosController.php" method="POST" enctype="multipart/form-data">

            <label for="title">Título:</label>
            <input type="text" id="title" name="titulo" required><br><br>

            <label for="description">Descrição:</label>
            <textarea id="description" name="descricao" required></textarea><br><br>

            <label for="price">Preço:</label>
            <input type="number" id="price" name="preco" step="0.01" required><br><br>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required><br><br>

            <input type="submit" value="Create Product">

        </form>
    </section>
    <section class="listagem Livroes">
        <?php 
         $books = getAll();
         echo '<table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Ativo?</th>
                        <th>Editar</th>
                        <th>Ativar / Desativar</th>
                    </tr>
                </thead>
                <tbody>';
         while ($book = $books->fetch_assoc()):
             echo  '<tr>
                        <td>'.$book['productId'].'</td>
                        <td>'.$book['productName'].'</td>
                        <td>'.($book['isActive']==1? "Sim": "Não").'</td>
                        <td>Editar</td>
                        <td>'.($book['isActive']==1? "Desativar": "Ativar").'</td>
                    </tr>';
         endwhile;
         echo ' </tbody>
               </table>'
        ?>
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