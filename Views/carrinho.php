<?php
include('../Controllers/CarrinhoController.php');
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

<body>
    <?php include 'Includes/header.php'; ?>
    <hr />

    <h1 class="carrinhoTitulo">Carrinho</h1>
    <?php
    $itemsQtd = array_count_values($_SESSION['cart']);
    $items = GetItemsCarrinho();
    foreach ($items as $item):
    ?>
        <div class="row mt-1 ps-4 pe-4">
            <div class="col-sm-1 px-3 my-3 text-center d-flex align-items-center"><img src="<?php echo 'data:image/jpeg;base64,' . $item['productImg']; ?>" width="100" height="120" alt="..."></div>
            <div class="col-sm-9 px-3 mb-1 d-flex align-items-center"><?php echo $item['productName']; ?></div>
            <div class="col-sm-1 px-3 mb-1 text-end d-flex align-items-center"><?php echo $item['productPrice']; ?></div>
            <div class="col-sm-1 px-3 mb-1 text-center d-flex align-items-center"><?php echo $itemsQtd[$item['productId']]; ?></div>
        </div>
    <?php endforeach; ?>
    <div class="row mt-1 d-flex justify-content-end pe-5 align-items-center">
        <span class="text-end me-5 mb-3">Total: <?php echo CalculaTotal(); ?></span>
    </div>
    <div class="botoesCarrinho">
        <button type="submit" class="botaoComprar">Finalizar Compra</button>
        <button type="submit" class="botaoContinuar">Continuar Comprando</button>
    </div>
</body>
<hr />
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

</html>