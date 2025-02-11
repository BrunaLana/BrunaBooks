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
$livros = Livro::getAllLivrosAdmin();
?>
<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<link rel="stylesheet" href="../Styles/livroCreate.css">

<?php
if (isset($_GET['edit_id'])) {
    $livroToEdit = Livro::getLivroById($_GET['edit_id']);
?>
    <h2 class="titulo">Editar Livro</h2>
    <section class="cadastro_Livros">
        <form class="form_livro_create" action="../controllers/LivrosController.php" method="POST" enctype="multipart/form-data" style="width: 30%;">
            <input type="hidden" name="id" value="<?php echo $livroToEdit->productId; ?>">
            <input type="hidden" name="action" value="update">
            <div class="form-group">
                <label for="edit_title">Título</label>
                <input type="text" class="form-control texto-campos" id="edit_title" name="titulo" value="<?php echo $livroToEdit->productName; ?>" required>
            </div>

            <div class="form-group">
                <label for="edit_description">Descrição</label>
                <textarea id="edit_description" class="form-control" name="descricao" required><?php echo $livroToEdit->productDesc; ?></textarea>
            </div>

            <div class="form-group">
                <label for="edit_price">Preço</label>
                <input type="number" class="form-control texto-campos" id="edit_price" name="preco" step="0.01" value="<?php echo $livroToEdit->productPrice; ?>" required>
            </div>

            <div class="form-group">
                <label for="edit_quantity">Quantidade</label>
                <input type="number" class="form-control texto-campos" id="edit_quantity" name="quantidade" value="<?php echo $livroToEdit->ProductQtt; ?>" required>
            </div>

            <div class="form-group form-check">
                <label class="switch">
                    <input type="checkbox" id="isActive" name="isActive" <?php echo ($livroToEdit->isActive ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                </label>
                <label class="form-check-label" for="isActive">Ativo</label>
            </div>

            <button type="submit" class="registroBotao btn botao-confirm">Salvar</button>
            <a href="../views/livroCreate.php" class="registroBotao btn botao-delete">Cancelar</a>

        </form>
    </section>
<?php } else {?>
<h2 class="titulo">Cadastro de Livro</h2>
<section class="cadastro_Livros">
    <form class="form_livro_create" action="../controllers/LivrosController.php" method="POST" enctype="multipart/form-data" style="width: 30%;">
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

        <div class="form-group">
            <label for="quantity">Quantidade</label>
            <input type="number" class="form-control texto-campos" id="quantity" name="quantidade" required>
        </div>
        <button type="submit" class="registroBotao btn botao-confirm">Salvar</button>
    </form>
</section>
<?php } ?>
<section class="listagemLivros container mb-0">
    <div class="container mt-5">
        <h2 class="titulo">Listagem de Livros</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Qtd Estoque</th>
                    <th>Ativo?</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?php echo $livro->productId; ?></td>
                        <td><?php echo $livro->productName; ?></td>
                        <td><?php echo $livro->ProductQtt; ?></td>
                        <td><?php echo $livro->isActive ? 'Sim' : 'Não'; ?></td>
                        <td>
                            <a href="?edit_id=<?php echo $livro->productId; ?>" class="btn botao-confirm btn-sm">Editar</a>
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