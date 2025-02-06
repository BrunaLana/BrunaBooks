<?php
require_once '../conn.php';

class Order
{ 
    public $productImg;
    public $productPrice;
    public $productQtt;
    public $encomendaId;
    public $userId;
    public $moradaId;
    public $morada;
    public $numero;
    public $complemento;
    public $freguesia;
    public $conselho;
    public $distrito;
    public $codigoPostal;
    public $pais;
    public $items;

    public static function getOrdersByUserId($userId)
    {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('SELECT * 
                                from tbl_encomendas as e 
                                inner join tbl_users as u on e.userId = u.userId
                                inner join tbl_morada as m on e.moradaId = m.moradaId
                                inner join tbl_encomenda_products as ep on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId
                                where u.userId = ?;');
        $stmt->execute([$userId]);       
        
        $result = $stmt->get_result();       

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->productImg = $row['productImg'];
            $order->productPrice = $row['productPrice'];
            $order->productQtt = $row['productQtt'];
            $order->encomendaId = $row['encomendaId'];
            $orders[] = $order;
        }
        
        $stmt->close();
        closeConnection($conn);
        return $orders;
    }

    public static function getOrderDetail($orderId)
    {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('SELECT * 
                                from tbl_encomendas as e 
                                inner join tbl_users as u on e.userId = u.userId
                                inner join tbl_morada as m on e.moradaId = m.moradaId
                                inner join tbl_encomenda_products as ep on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId
                                where e.encomendaId = ?;');
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $orderDetails = [];
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }
        $stmt->close();
        closeConnection($conn);
        return $orderDetails;
    }

    public function save($conn)
    {
        $stmt = $conn->prepare('INSERT INTO tbl_morada (morada, numero, complemento, freguesia, conselho, distrito, codigoPostal, pais) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssss', $this->morada, $this->numero, $this->complemento, $this->freguesia, $this->conselho, $this->distrito, $this->codigoPostal, $this->pais);
        $stmt->execute();
        $this->moradaId = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare('INSERT INTO tbl_encomendas (userId, moradaId) VALUES (?, ?)');
        $stmt->bind_param('ii', $this->userId, $this->moradaId);
        $stmt->execute();
        $this->encomendaId = $stmt->insert_id;
        $stmt->close();

        foreach ($this->items as $item) {
            $stmt = $conn->prepare('INSERT INTO tbl_encomenda_products (encomendaId, productId, productQtt) VALUES (?, ?, ?)');
            $stmt->bind_param('iii', $this->encomendaId, $item, 1);
            $stmt->execute();
            $stmt->close();
        }
    }
}
