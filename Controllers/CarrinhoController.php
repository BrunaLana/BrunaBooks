<?php
include('../conn.php');
session_start();


function GetItemsCarrinho()
{
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        $conn = getDatabaseConnection();

        
        $cart = $_SESSION['cart'];
        $total = 0;

        // Prepare the SQL statement
        //$placeholders = implode(',', array_fill(0, count($cart), '?'));
        $placeholders = implode('\', \'', $cart );
        //echo $placeholders;
        //echo ("SELECT * FROM tbl_products WHERE productId IN ($placeholders)");
        $sql = ("SELECT * FROM tbl_products WHERE productId IN ('".$placeholders."')");

        // Get the result
        $items = $conn->query($sql);

        // Close the connection
       closeConnection($conn);

        return $items;
    }
}

function CalculaTotal(){
 
    $total = 0;
    $items = GetItemsCarrinho();
    $itemsQtd= array_count_values($_SESSION['cart']);
    foreach ($items as $item) {
        $total += $item['productPrice'] * $itemsQtd[$item['productId']];
    }
    return $total;
}

?>