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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Usuários</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include '../Includes/header.php'; ?>
    <div class="container mt-5">
        <h1>Gestão de Usuários</h1>
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
                            <a href="editUser.php?id=<?php echo $user->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="deleteUser.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>