<!DOCTYPE html>
<html>
<?php
require_once '../Helpers/SessionHelper.php';
require_once '../Models/Order.php'; // Assuming you have an Order model for order operations
require_once '../Models/User.php'; // Assuming you have a User model for user operations
require_once '../Models/Address.php'; // Assuming you have an Address model for address operations

// Verifica se o usuário está logado
if (!SessionHelper::isLoggedIn()) {
    $_SESSION['error_message'] = 'Para realizar o check out do seu carrinho, é preciso estar Logado!';
    header('Location: ../Views/login.php');
    exit();
}

$user = User::getUserById(SessionHelper::getUserId());
$addresses = Address::getAddressesByUserId($user->id);

$morada = $numero = $complemento = $freguesia = $conselho = $distrito = $codigoPostal = $pais = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $morada = $_POST['morada'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $freguesia = $_POST['freguesia'];
    $conselho = $_POST['conselho'];
    $distrito = $_POST['distrito'];
    $codigoPostal = $_POST['codigoPostal'];
    $pais = $_POST['pais'];

    // Validate form fields
    if (empty($morada) || empty($numero) || empty($complemento) || empty($freguesia) || empty($conselho) || empty($distrito) || empty($codigoPostal) || empty($pais)) {
        echo '<script>alert("Todos os campos são obrigatórios.");</script>';
    } else {
        // Validate user age
        $birthDate = new DateTime($user->dataNasc);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;

        if (!$age < 18) {
            echo '<script>alert("Você precisa ter mais de 18 anos para realizar um pedido.");</script>';
        } else {
            // Save order to the database
            $conn = getDatabaseConnection();
            $conn->begin_transaction();

            try {
                $order = new Order();
                $order->userId = $user->id;
                $order->morada = $morada;
                $order->numero = $numero;
                $order->complemento = $complemento;
                $order->freguesia = $freguesia;
                $order->conselho = $conselho;
                $order->distrito = $distrito;
                $order->codigoPostal = $codigoPostal;
                $order->pais = $pais;
                $order->items = $_SESSION['cart'];

                $order->save($conn);

                $conn->commit();
                $_SESSION['cart'] = [];
                header('Location: pedido_sucesso.php');
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
                    <label class="registroTexto" for="addressSelect">Selecionar Morada</label>
                    <select class="form-control texto-campos" id="addressSelect" onchange="fillAddressFields(this.value)">
                        <option value="">Selecione uma morada</option>
                        <?php foreach ($addresses as $address): ?>
                            <option value="<?= htmlspecialchars(json_encode($address)) ?>"><?= htmlspecialchars($address->morada) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label class="registroTexto" for="morada">Morada</label>
                    <input type="text" class="form-control texto-campos" name="morada" id="morada" value="<?= htmlspecialchars($morada) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="numero">Número</label>
                    <input type="text" class="form-control texto-campos" id="numero" name="numero" value="<?= htmlspecialchars($numero) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="complemento">Complemento</label>
                    <input type="text" class="form-control texto-campos" id="complemento" name="complemento" value="<?= htmlspecialchars($complemento) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="freguesia">Freguesia</label>
                    <input type="text" class="form-control texto-campos" id="freguesia" name="freguesia" value="<?= htmlspecialchars($freguesia) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="conselho">Conselho</label>
                    <input type="text" class="form-control texto-campos" id="conselho" name="conselho" value="<?= htmlspecialchars($conselho) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="distrito">Distrito</label>
                    <input type="text" class="form-control texto-campos" id="distrito" name="distrito" value="<?= htmlspecialchars($distrito) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="codigoPostal">Cód.Postal</label>
                    <input type="text" class="form-control texto-campos" id="codigoPostal" name="codigoPostal" value="<?= htmlspecialchars($codigoPostal) ?>" required>
                </div>

                <div class="form-group">
                    <label class="registroTexto" for="pais">País</label>
                    <input type="text" class="form-control texto-campos" id="pais" name="pais" value="<?= htmlspecialchars($pais) ?>" required>
                </div>

                <div style="text-align:right;">
                    <button type="submit" class="btn botao-confirm">Confirmar Pedido</button>
                    <a href="../Views/carrinho.php" class="btn botao-delete">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include '../Includes/contatoFooter.php'; ?>
</html>