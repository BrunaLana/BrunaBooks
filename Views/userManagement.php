<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/User.php';

SessionHelper::startSession();

// Verifica se o usuário está logado e se é administrador
if (!SessionHelper::isLoggedIn() || $_SESSION['userrole'] !== 'admin') {
    $_SESSION['error_message'] = 'Acesso negado. Somente administradores podem acessar a página de gestão de usuário!';
    header('Location: ../Views/login.php');
    exit();
}

// Lógica para obter a lista de usuários
$users = User::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../Includes/header.php'; ?>
<hr />
<div class="container mt-5">
    <h2 class="titulo">Gestão de Usuários</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome de Usuário</th>
                <th>Email</th>
                <th>Role</th>
                <th>Nickname</th>
                <th>Apelido</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->userrole; ?></td>
                    <td><?php echo $user->nickname; ?></td>
                    <td><?php echo $user->apelido; ?></td>
                    <td><?php echo $user->dataNasc; ?></td>
                    <td>
                        <a href="?id=<?php echo $user->id; ?>" class="btn botao-confirm btn-sm">Editar</a>
                        <a href="../Controllers/UserController.php?action=delete&id=<?php echo $user->id; ?>" class="btn botao-delete btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (isset($_GET['id'])): ?>
    <?php
    $userToEdit = User::getUserById($_GET['id']);
    if ($userToEdit):
    ?>
        <div class="container mt-5">
            <h2 class="titulo">Editar Usuário</h2>
            <form action="../Controllers/UserController.php?action=update" method="post">
                <input type="hidden" name="id" value="<?php echo $userToEdit->id; ?>">
                <div class="form-group">
                    <label for="username">Nome de Usuário</label>
                    <input type="text" class="form-control texto-campos" id="username" name="username" value="<?php echo $userToEdit->username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control texto-campos" id="email" name="email" value="<?php echo $userToEdit->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control texto-campos" id="nickname" name="nickname" value="<?php echo $userToEdit->nickname; ?>" required>
                </div>
                <div class="form-group">
                    <label for="apelido">Apelido</label>
                    <input type="text" class="form-control texto-campos" id="apelido" name="apelido" value="<?php echo $userToEdit->apelido; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento</label>
                    <input type="date" class="form-control texto-campos" id="dataNasc" name="dataNasc" value="<?php echo $userToEdit->dataNasc; ?>" required>
                </div>
                <div class="form-group form-check">
                    <label class="switch">
                        <input type="checkbox" id="isAdmin" name="isAdmin" <?php echo ($userToEdit->userrole == 'admin') ? 'checked' : ''; ?>>
                        <span class="slider round"></span>
                    </label>
                    <label class="form-check-label" for="isAdmin">Administrador</label>
                </div>
                <button type="submit" class="btn botao-confirm">Salvar Alterações</button>
                <a href="./userManagement.php" class="btn botao-delete">Cancelar</a>
            </form>
        </div>
    <?php endif; ?>
<?php endif; ?>
</body>

</html>