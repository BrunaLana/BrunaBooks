<?php

ini_set('max_execution_time', 30); // Increase the maximum execution time to 60 seconds

$servername = "localhost";
$username = "root";
$password = "123456*";
$dbname = "brunabooks";

function getDatabaseConnection() {
    global $servername, $username, $password, $dbname;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeConnection($conn) {
    if ($conn != null) {
        $conn->close();
    }
}
?>