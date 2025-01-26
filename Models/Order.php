<?php
require_once '../conn.php';

class Order {
    public static function getOrdersByUserId($userId) {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM orders WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>