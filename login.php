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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="cabecalho">
            <div class="container">

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
                    <li class="lista-menu__item"><a href="#" class="lista-menu__link">Todos</a></li>
                    <li class="lista-menu__item"><a href="#" class="lista-menu__link">Programação</a></li>
                    <li class="lista-menu__item"><a href="#" class="lista-menu__link">Redes</a></li>
                    <li class="lista-menu__item"><a href="#" class="lista-menu__link">Design & UX</a></li>
                </ul>

                <li class="opcoes__item"><a href="#" class="opcoes__link">Home</a></li>                
                <li class="opcoes__item"><a href="#" class="opcoes__link">Contato</a></li>                  
            </ul>
            <div class="container">                            
                
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