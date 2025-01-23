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

<body>
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