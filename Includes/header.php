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
            error_log($_SESSION['userrole']);
            if (isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin')
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