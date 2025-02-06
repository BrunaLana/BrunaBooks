<!DOCTYPE html>
<html>
<?php
require_once '../Controllers/LoginController.php';
require_once '../Helpers/SessionHelper.php';

SessionHelper::startSession();

// Verifica se o usuário está logado
if (SessionHelper::isLoggedIn()) {
    header('Location: ../index.php');
    exit();
}

$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $user_senha = $_POST['user_senha'];
    try {
        $user = login($user_name, $user_senha);

        if (!$login_error) {
            header('Location: Views/index.php');
            exit();
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}
if (!empty($error_message  && str_contains($error_message, 'carrinho'))) {
    echo '<script>alert("' . $error_message . '");</script>';
}
?>
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/login.css">
<div class="loginTotal">
    <div class="login">
        <div class="loginDescricao">
            <form method="POST" class="loginEntrar">
                <h2 class="loginTitulo">Iniciar Sessão</h2>
                <div class="form-group">
                    <p class="loginTexto">Nome de Usuário</p>
                    <input type="text" class="form-control texto-campos" name="user_name" required>
                </div>

                <div class="form-group">
                    <p class="loginTexto">Senha</p>
                    <input type="password" class="form-control texto-campos mb-0" name="user_senha" required>
                    <?php
                    if (!empty($error_message) && str_contains($error_message, 'Invalid username or password')) {
                        echo '<p style="margin-top:0px; color:red; font-size:13px;margin-bottom:0px">' . $error_message . '</p>';
                    }
                    ?>
                </div>

                <button type="submit" class="btn botao-confirm mt-3">Entrar</button>
            </form>
            <hr>
            <div class="loginRegistro">
                <h2 class="loginTitulo">Ainda não tem uma conta?</h2>
                <p class="loginTexto" id="textoRegistro">Se ainda não tem uma conta crie aqui e tenha acesso a
                    muitas vantagens!</p>

                <a href="../Views/registro.php" class="btn botao-confirm">Criar conta</a>
            </div>
        </div>
    </div>
</div>
<?php include '../Includes/contatoFooter.php'; ?>

</html>