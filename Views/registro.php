<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/registro.css">
<div class="registroTotal">
    <form method="POST" action="../Controllers/UserController.php" class="registro">
        <div class="registroDescricao">
            <div class="registroEntrar">
                <h2 class="titulo">Crie uma conta com seu e-mail</h2>

                <div class="form-group">
                    <label class="registroTexto" for="nome">Nome</label>
                    <input type="text" class=" form-control texto-campos" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="apelido">Apelido</label>
                    <input type="text" class=" form-control texto-campos" id="apelido" name="apelido" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="email">Email</label>
                    <input type="email" class=" form-control texto-campos" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="userNickName">Nome de Usuário</label>
                    <input type="text" class=" form-control texto-campos" id="userNickName" name="userNickName" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="senha">Senha</label>
                    <input type="password" class=" form-control texto-campos" id="senha" name="senha" required>
                </div>

                <button type="submit" class="registroBotao btn botao-confirm">Registrar</button>
            </div>
        </div>
    </form>
</div>
<?php include "../Includes/contatoFooter.php"; ?>

</html>