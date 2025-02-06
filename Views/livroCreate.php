<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Livro.php';

SessionHelper::startSession();

// Verifica se o usuário está logado e se é administrador
if (!SessionHelper::isLoggedIn() || $_SESSION['userrole'] !== 'admin') {
    $_SESSION['error_message'] = 'Acesso negado. Somente administradores podem acessar a página de gestão de usuário!';
    header('Location: ../index.php');
    exit();
}
// Lógica para obter a lista de usuários
$livros = Livro::getAllLivros();
?>
<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/livroCreate.css">
<h2 class="titulo">Cadastro de Livro</h1>
    <section class="cadastro_Livros">
        <form class="form_livro_create" action="../controllers/LivrosController.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control texto-campos" id="title" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea id="description" class="form-control" name="descricao" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Preço</label>
                <input type="number" class="form-control texto-campos" id="price" name="preco" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control texto-campos" id="imagem" name="imagem" accept="image/*" required>
            </div>
            <button type="submit" class="registroBotao btn botao-confirm">Salvar</button>
        </form>
    </section>
    <section class="listagemLivros container mt-5">
        <div class="container mt-5">
            <h2 class="titulo">Listagem de Livros</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Ativo?</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>';

                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?php echo $livro->productId; ?></td>
                            <td><?php echo $livro->productName; ?></td>
                            <td><?php echo $livro->isActive ? 'Sim' : 'Não'; ?></td>
                            <td>
                                <a href="?id=<?php echo $livro->productId; ?>" class="btn botao-confirm btn-sm">Editar</a>
                                <a href="../Controllers/LivrosController.php?action=delete&id=<?php echo $livro->productId; ?>" class="btn botao-delete btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php include '../Includes/contatoFooter.php'; ?>

</html>