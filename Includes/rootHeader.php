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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'Includes/confirmDialog.php'; ?>
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
            <a href="#" class="container__link">
                <img src="Icons/Logo.svg" alt="logo BrunaBooks" class="container__imagem">
                <h1 class="container__titulo"><b class="container__titulo--negrito">Bruna</b>Books</h1>
            </a>
        </div>
        <ul class="opcoes">
            <li class="opcoes__item pt-2"><a href="Views/livros.php" class="lista-menu__link">Livros</a></li>
            <li class="opcoes__item pt-2"><a href="#" class="opcoes__link">Home</a></li>
            <ul class="menu-admin">
                <input type="checkbox" id="opcoes-menu-admin" class="opcoes__botao__admin">
                <label for="opcoes-menu-admin" class="opcoes__rotulo__admin">
                    <li class="opcoes__item__admin pt-2">ADMIN</li>
                </label>
                <ul class="lista-menu-admin" style="z-index:9999;">
                    <li class="lista-menu__item"><a href="views/livroCreate.php" class="lista-menu__link">Cadastro de
                            Produto</a></li>
                    <li class="lista-menu__item"><a href="views/userManagement.php" class="lista-menu__link">Gerir
                            Usuário</a></li>
                    <li class="lista-menu__item"><a href="views/gestaoPedidos.php" class="lista-menu__link">Gerir
                            Pedidos</a></li>
                </ul>
            </ul>
        </ul>
        <div class="containers">
            <a href="./Views/carrinho.php" class="container__link">
                <img src="Icons/Compras.svg" alt="Carrinho de compra" class="container__imagem">
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    $itemCount = 0;
                    foreach ($_SESSION['cart'] as $id => $quantity) {
                        $itemCount += $quantity;
                    }
                ?>
                    <span class="badge"><?= $itemCount ?></span>
                <?php endif; ?>
                <p class="container__texto mb-0">Minha sacola</p>
            </a>
            <div class="dropdown">
                <a href="#" class="container__link dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="Icons/Usuário.svg" alt="Meu perfil" class="container__imagem">
                    <div>
                        <p class="container__texto mb-0">Meu perfil</p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <span class="boasVindas">Olá, <?= htmlspecialchars($_SESSION['username']); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a class="dropdown-item" href="views/meusPedidos.php">Pedidos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="Controllers/LogoutController.php">Sair</a></li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="views/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>
    <hr class="m-0" />