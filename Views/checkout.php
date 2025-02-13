<!DOCTYPE html>
<html>
<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Order.php'; 
require_once '../Models/User.php'; 
require_once '../Models/Address.php'; 

// Verifica se o usuário está logado
if (!SessionHelper::isLoggedIn()) {
    $_SESSION['error_message'] = 'Para realizar o check out do seu carrinho, é preciso estar Logado!';
    header('Location: ../Views/login.php');
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error_message'] = 'Seu carrinho está vazio!';
    header('Location: ../Views/livros.php');
    exit();
}

$user = User::getUserById(SessionHelper::getUserId());
$addresses = Address::getAddressesByUserId($user->id);

$moradaId = $nomeMorada = $morada = $numeroMorada = $complementoMorada = $freguesiaMorada = $conselhoMorada = $distritoMorada = $cpMorada = $paisMorada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $moradaId = $_POST['moradaId'];
    $nomeMorada = $_POST['nomeMorada'];
    $morada = $_POST['morada'];
    $numeroMorada = $_POST['numero'];
    $complementoMorada = $_POST['complemento'];
    $freguesiaMorada = $_POST['freguesia'];
    $conselhoMorada = $_POST['conselho'];
    $distritoMorada = $_POST['distrito'];
    $cpMorada = $_POST['codigoPostal'];
    $paisMorada = $_POST['pais'];

    // Validate form fields
    if (empty($nomeMorada) || empty($morada) || empty($numeroMorada) || empty($complementoMorada) || empty($freguesiaMorada) || empty($conselhoMorada) || empty($distritoMorada) || empty($cpMorada) || empty($paisMorada)) {
        echo '<script>alert("Todos os campos são obrigatórios.");</script>';
    } else {
        // Validate user age
        $birthDate = new DateTime($user->dataNasc);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;

        if ($age < 18) {
            echo '<script>alert("Você precisa ter mais de 18 anos para realizar um pedido.");</script>';
        } else {
            // Save order to the database
            $conn = getDatabaseConnection();
            $conn->begin_transaction();

            try {
                $order = new Order();
                $order->userId = $user->id;
                $order->moradaId = $moradaId;
                $order->morada = $morada;
                $order->nomeMorada = $nomeMorada;
                $order->numero = $numeroMorada;
                $order->complemento = $complementoMorada;
                $order->freguesia = $freguesiaMorada;
                $order->conselho = $conselhoMorada;
                $order->distrito = $distritoMorada;
                $order->codigoPostal = $cpMorada;
                $order->pais = $paisMorada;
                $order->items = $_SESSION['cart'];

                $order->save($conn);

                $conn->commit();
                $_SESSION['cart'] = [];
                $_SESSION['checkout_success'] = 'Seu pedido foi realizado com sucesso!';
                header('Location: pedidoSucesso.php');
                exit();
            } catch (Exception $e) {
                $conn->rollback();
                $_SESSION['error_message'] = 'Ocorreu um erro ao processar seu pedido. Por favor, tente novamente.';
                header('Location: checkout.php');
                exit();
            }
        }
    }
}
?>
<?php include '../Includes/header.php'; ?>

<link rel="stylesheet" href="../Styles/registro.css">
<div class="registroTotal">
    <form method="Post" action="checkout.php" class="registroTotal">
        <div class="registroDescricao">
            <div class="registroEntrar">
                <h2 class="titulo">Morada para entrega</h2>
                
                <?php if (!empty($addresses)): ?>
                <div class="form-group">
                    <label class="registroTexto" for="addressSelect">Nova Morada</label>
                    <select class="form-control texto-campos" id="addressSelect" onchange="fillAddressFields(this.value)">
                        <option value="">Selecione uma morada ou cadastre uma nova</option>
                        <?php foreach ($addresses as $address): ?>
                            <option value="<?= htmlspecialchars(json_encode($address)) ?>"><?= htmlspecialchars($address->nomeMorada) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>                          
                <input type="hidden" id="moradaId" name="moradaId" value="<?= htmlspecialchars($moradaId) ?>">
                <div class="form-group">
                    <label class="registroTexto" for="nomeMorada">Dê um nome para esta morada (casa, trabalho...)</label>
                    <input type="text" class="form-control texto-campos" name="nomeMorada" id="nomeMorada" value="<?= htmlspecialchars($nomeMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="morada">Morada</label>
                    <input type="text" class="form-control texto-campos" name="morada" id="morada" value="<?= htmlspecialchars($morada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="numero">Número</label>
                    <input type="text" class="form-control texto-campos" id="numero" name="numero" value="<?= htmlspecialchars($numeroMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="complemento">Complemento</label>
                    <input type="text" class="form-control texto-campos" id="complemento" name="complemento" value="<?= htmlspecialchars($complementoMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="freguesia">Freguesia</label>
                    <input type="text" class="form-control texto-campos" id="freguesia" name="freguesia" value="<?= htmlspecialchars($freguesiaMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="conselho">Conselho</label>
                    <input type="text" class="form-control texto-campos" id="conselho" name="conselho" value="<?= htmlspecialchars($conselhoMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="distrito">Distrito</label>
                    <input type="text" class="form-control texto-campos" id="distrito" name="distrito" value="<?= htmlspecialchars($distritoMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="codigoPostal">Cód.Postal</label>
                    <input type="text" class="form-control texto-campos" id="codigoPostal" name="codigoPostal" value="<?= htmlspecialchars($cpMorada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="pais">País</label>
                    <input type="text" class="form-control texto-campos" id="pais" name="pais" value="<?= htmlspecialchars($paisMorada) ?>" required>
                </div>

                <div style="text-align:right;">
                    <button type="submit" class="btn botao-confirm">Confirmar Pedido</button>
                    <a href="../Views/carrinho.php" class="btn botao-delete">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="../Scripts/checkout.js"></script>
<?php include '../Includes/contatoFooter.php'; ?>
</html>