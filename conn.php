<?php
$globalPDOConnection = null;

function getDatabaseConnection()
{
    global $globalPDOConnection;
    if ($globalPDOConnection === null) {        
        $dbServername = "localhost";
        $dbUser = "root";
        $dbPassword = "123456*";
        $dbName = "brunabooks";
        try {
            $globalPDOConnection =  mysqli_connect($dbServername, $dbUser, $dbPassword, $dbName);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }    
    return $globalPDOConnection;
}

function closeConnection()
{
    global $globalPDOConnection;
    try {
        if ($globalPDOConnection != null) {
            $globalPDOConnection->close();
        }
        
    } catch (\Throwable $th) {
        throw new Exception($th->getMessage());
    }
}
