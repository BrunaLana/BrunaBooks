<!DOCTYPE html>
<html>
<?php
require_once '../Controllers/LoginController.php';

SessionHelper::startSession();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $user_senha = $_POST['user_senha'];
    try {
        $user = login($user_name, $user_senha);

        echo $_SESSION['user_id'];

        //if (!$login_error) {
        //  fheader('Location: /dashboard');
        //  exit();
        //}
    } catch (\Throwable $th) {
        throw $th;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device width, initial-scale=1.0">
    <title>BrunaBooks</title>

    <link rel="stylesheet" href="../reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include 'Includes/header.php'; ?>
    <div class="loginTotal">
        <div class="login">
            <div class="loginDescricao">
                <form method="POST" class="loginEntrar">
                    <h2 class="loginTitulo">Iniciar Sessão</h2>
                    <p class="loginTexto">Nome de Usuário</p>
                    <input type="text" class="loginCampos" name="user_name" required>

                    <p class="loginTexto">Senha</p>
                    <input type="password" class="loginCampos" name="user_senha" required><br>

                    <?php

                    if (isset($login_error)) {
                        echo '<p style="color:red; font-size:13px;margin-bottom:20px">' . $login_error . '</p>';
                    }

                    ?>

                    <button type="submit" class="loginBotao">Entrar</button>


                </form>

                <hr>

                <div class="loginRegistro">
                    <h2 class="loginTitulo">Ainda não tem uma conta?</h2>
                    <p class="loginTexto" id="textoRegistro">Se ainda não tem uma conta crie aqui e tenha acesso a
                        muitas vantagens!</p>

                    <a href="../Views/registro.php" class="loginBotao">Criar conta</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="rodape">
        <h2 class="rodape__titulo">Grupo B.LANA</h2>

    </footer>