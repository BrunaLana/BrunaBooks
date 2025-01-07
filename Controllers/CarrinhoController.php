<?php
include('../conn.php');
session_start();
$conn = getDatabaseConnection();

function GetItemsCarrinho()
{
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        global $conn;
        $cart = $_SESSION['cart'];
        $total = 0;

        // Prepare the SQL statement
        $placeholders = implode(',', array_fill(0, count($cart), '?'));
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE productId IN ($placeholders)");

        // Bind the parameters
        $stmt->bind_param(str_repeat('i', count($cart)), ...$cart);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $items = $stmt->get_result();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        return $items;
    }
}
?>