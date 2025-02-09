<?php
require_once '../conn.php';

class Order
{
    public $productImg;
    public $productName;
    public $productPrice;
    public $productQtt;
    public $encomendaId;
    public $userId;
    public $moradaId;
    public $nomeMorada;
    public $morada;
    public $numero;
    public $complemento;
    public $freguesia;
    public $conselho;
    public $distrito;
    public $codigoPostal;
    public $pais;
    public $items;
    public $totalOrderPrice;
    public $dataEncomenda;
    public $status;
    public $statusId;
    


    public static function getOrdersByUserId($userId)
    {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('SELECT e.encomendaId,e.dataEncomenda, s.statusDesc,s.statusId, sum(p.productPrice  * ep.productQtt) as total                                 
                                from tbl_encomendas as e 
                                inner join tbl_status as s on e.statusId = s.statusId
                                inner join tbl_users as u on e.userId = u.userId
                                inner join tbl_morada as m on e.moradaId = m.moradaId
                                inner join tbl_encomenda_products as ep on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId
                                where e.userId = ?
                                group by e.encomendaId,
                                e.dataEncomenda,
                                s.statusDesc,
                                s.statusId;');
        $stmt->execute([$userId]);

        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->encomendaId = $row['encomendaId'];
            $order->totalOrderPrice = $row['total'];
            $order->dataEncomenda = date('d/m/Y', strtotime($row['dataEncomenda']));
            $order->status = $row['statusDesc'];
            $order->statusId = $row['statusId'];
            
            $orders[] = $order;
        }

        $stmt->close();
        closeConnection($conn);
        return $orders;
    }
    public static function getOrderitemsByOrderId($orderId)
    {
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('SELECT * 
                                from tbl_encomenda_products as ep
                                inner join tbl_encomendas as e  on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId                                
                                where e.encomendaId = ?
                                order by p.productId;');
        $stmt->execute([$orderId]);

        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->productImg = $row['productImg'];
            $order->productName = $row['productName'];
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



    public static function getAllOrders() {
        $conn = getDatabaseConnection();  
        $stmt = $conn->prepare('SELECT 
                                    e.encomendaId,
                                    e.dataEncomenda, 
                                    s.statusDesc,
                                    s.statusId,
                                    (select count(eps.encomendaId) from tbl_encomenda_products as eps where eps.encomendaId = e.encomendaId) as `productQtt`,
                                    sum(p.productPrice  * ep.productQtt) as total                                 
                                from tbl_encomendas as e 
                                inner join tbl_status as s on e.statusId = s.statusId
                                inner join tbl_users as u on e.userId = u.userId
                                inner join tbl_morada as m on e.moradaId = m.moradaId
                                inner join tbl_encomenda_products as ep on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId
                                group by e.encomendaId,
                                e.dataEncomenda,
                                s.statusDesc,
                                s.statusId,
                                `productQtt`;');
        $stmt->execute();

        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->encomendaId = $row['encomendaId'];
            $order->totalOrderPrice = $row['total'];
            $order->dataEncomenda = date('d/m/Y', strtotime($row['dataEncomenda']));
            $order->status = $row['statusDesc'];
            $order->statusId = $row['statusId'];
            $order->productQtt = $row['productQtt'];
            $orders[] = $order;
        }

        $stmt->close();
        closeConnection($conn);
        return $orders;
    }


    
    public static function updateOrderStatus($orderId, $status) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare("UPDATE tbl_encomendas SET statusId = ? WHERE encomendaId = ?");
        $stmt->bind_param('si', $status, $orderId);
        $stmt->execute();
    }

    public function save($conn)
    {
        // Save address and assign to user
        if (!$this->moradaId) {
            $stmt = $conn->prepare('INSERT INTO tbl_morada (nomeMorada, morada, numeroMorada, complementoMorada, freguesiaMorada, conselhoMorada, distritoMorada, cpMorada, paisMorada) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssssss', $this->nomeMorada, $this->morada, $this->numero, $this->complemento, $this->freguesia, $this->conselho, $this->distrito, $this->codigoPostal, $this->pais);
            $stmt->execute();
            $this->moradaId = $stmt->insert_id;
            $stmt->close();

            $stmt = $conn->prepare('INSERT INTO tbl_user_morada (userId, moradaId) VALUES (?, ?)');
            $stmt->bind_param('ii', $this->userId, $this->moradaId);
            $stmt->execute();
            $stmt->close();
        }

        $stmt = $conn->prepare('INSERT INTO tbl_encomendas (userId, moradaId) VALUES (?, ?)');
        $stmt->bind_param('ii', $this->userId, $this->moradaId);
        $stmt->execute();
        $this->encomendaId = $stmt->insert_id;
        $stmt->close();

        foreach ($this->items as $id => $quantity) {

            $stmt = $conn->prepare('UPDATE tbl_products SET productQtt = productQtt - ? WHERE productId = ?');
            $stmt->bind_param('ii', $quantity, $id);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare('INSERT INTO tbl_encomenda_products (encomendaId, productId, productQtt) VALUES (?, ?, ?)');
            $stmt->bind_param('iii', $this->encomendaId, $id, $quantity);
            $stmt->execute();
            $stmt->close();
        }
    }
}
