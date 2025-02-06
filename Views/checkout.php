<!DOCTYPE html>
<html>
<?php
require_once '../Helpers/SessionHelper.php';
// Verifica se o usuário está logado e se é administrador
if (!SessionHelper::isLoggedIn()) {
    $_SESSION['error_message'] = 'Para realizar o check out do seu carrinho, é preciso estar Logado!';
    header('Location: ../Views/login.php');
    exit();
}
?>
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/registro.css">
<div class="registroTotal">
    <form method="Post" action="../Controllers/CheckOutController.php " class="registroTotal">
        <div class="registroDescricao">
            <div class="registroEntrar">
                <h2 class="titulo">Morada para entrega</h2>

                <div class="form-group">
                    <label class="registroTexto" for="morada">Morada</label>
                    <input type="text" class="form-control texto-campos" name="morada" id="morada" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="numero">Número</label>
                    <input type="text" class="form-control texto-campos" id="numero" name="numero" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="complemento">Complemento</label>
                    <input type="text" class="form-control texto-campos" id="complemento" name="complemento" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="freguesia">Freguesia</label>
                    <input type="text" class="form-control texto-campos" id="freguesia" name="freguesia" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="conselho">Conselho</label>
                    <input type="text" class="form-control texto-campos" id="conselho" name="conselho" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="distrito">Distrito</label>
                    <input type="text" class="form-control texto-campos" id="distrito" name="distrito" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="codigoPostal">Cód.Postal</label>
                    <input type="text" class="form-control texto-campos" id="codigoPostal" name="codigoPostal" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="pais">País</label>
                    <input type="text" class="form-control texto-campos" id="pais" name="pais" required>
                </div>

                <div Style="text-align:right;">
                    <button type="submit" class="btn botao-confirm">Comprar</button>
                    <a href="../Views/carrinho.php" class="btn botao-delete">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include '../Includes/contatoFooter.php'; ?>

</html>