<?php
//require_once '../Database/Database.php';

class Address {

    public $moradaId;
    public $nomeMorada;
    public $morada;
    public $numeroMorada;
    public $complementoMorada;
    public $freguesiaMorada;
    public $conselhoMorada;
    public $distritoMorada;
    public $cpMorada;
    public $paisMorada;

    public static function getAddressesByUserId($userId) {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('select 
                                    tm.moradaId,
                                    tm.nomeMorada,
                                    tm.morada,
                                    tm.numeroMorada,
                                    tm.complementoMorada,
                                    tm.freguesiaMorada,
                                    tm.conselhoMorada,
                                    tm.distritoMorada,
                                    tm.cpMorada,
                                    tm.paisMorada 
                                from  tbl_users as tu 
                                inner join tbl_user_morada tum on tum.userId = tu.userId
                                inner join tbl_morada as tm on  tum.moradaId = tm.moradaId
                                where tu.userId = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = [];

        while ($row = $result->fetch_assoc()) {
            $address = new Address();
            $address->moradaId = $row['moradaId'];
            $address->nomeMorada = $row['nomeMorada'];
            $address->morada = $row['morada'];
            $address->numeroMorada = $row['numeroMorada'];
            $address->complementoMorada = $row['complementoMorada'];
            $address->freguesiaMorada = $row['freguesiaMorada'];
            $address->conselhoMorada = $row['conselhoMorada'];
            $address->distritoMorada = $row['distritoMorada'];
            $address->cpMorada = $row['cpMorada'];
            $address->paisMorada = $row['paisMorada'];
            $addresses[] = $address;
        }

        $stmt->close();
        $conn->close();

        return $addresses;
    }
}
?>
