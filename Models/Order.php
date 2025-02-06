<?php
require_once '../conn.php';

class Order
{ 
    public $productImg;
    public $productPrice;
    public $productQtt;
    public $encomendaId;

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
        global $conn;
        $stmt = $conn->prepare('SELECT * 
                                from tbl_encomendas as e 
                                inner join tbl_users as u on e.userId = u.userId
                                inner join tbl_morada as m on e.moradaId = m.moradaId
                                inner join tbl_encomenda_products as ep on ep.encomendaId = e.encomendaId
                                inner join tbl_products as p on ep.productId = p.productId
                                where e.encomendaId = ?;');
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
