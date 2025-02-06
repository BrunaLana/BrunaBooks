<?php
require_once '../Database/Database.php';

class Address {
    public $id;
    public $userId;
    public $morada;
    public $numero;
    public $complemento;
    public $freguesia;
    public $conselho;
    public $distrito;
    public $codigoPostal;
    public $pais;

    public static function getAddressesByUserId($userId) {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('SELECT * FROM addresses WHERE userId = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = [];

        while ($row = $result->fetch_assoc()) {
            $address = new Address();
            $address->id = $row['id'];
            $address->userId = $row['userId'];
            $address->morada = $row['morada'];
            $address->numero = $row['numero'];
            $address->complemento = $row['complemento'];
            $address->freguesia = $row['freguesia'];
            $address->conselho = $row['conselho'];
            $address->distrito = $row['distrito'];
            $address->codigoPostal = $row['codigoPostal'];
            $address->pais = $row['pais'];
            $addresses[] = $address;
        }

        $stmt->close();
        $conn->close();

        return $addresses;
    }
}
?>
