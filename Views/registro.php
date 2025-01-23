<!DOCTYPE html>
<html>
    <?php include 'Includes/header.php'; ?>
    <form method="POST" action="../Controllers/UserController.php" class="registroTotal">
        <div class="registro">
            <div class="registroDescricao">
                <div class="registroEntrar">
                    <h2 class="registroTitulo">Crie uma conta com seu e-mail</h2>

                    <p class="registroTexto">Nome</p>
                    <input type="text" class="registroCampos" name="nome" required>

                    <p class="registroTexto">Apelido</p>
                    <input type="text" class="registroCampos" name="apelido" required>

                    <p class="registroTexto">Email</p>
                    <input type="email" class="registroCampos" name="email" required>

                    <p class="registroTexto">Nome de Usuário</p>
                    <input type="text" class="registroCampos" name="userNickName" required>

                    <p class="registroTexto">Senha</p>
                    <input type="password"  class="registroCampos" name="senha" required><br>

                    <button type="submit" class="registroBotao">Registrar</button>                    
                    
                </div>
                
               
            </div>
        </div>
    </form>
    <footer class="rodape">
    <h2 class="rodape__titulo">Grupo B.LANA</h2>
</footer>

</html>