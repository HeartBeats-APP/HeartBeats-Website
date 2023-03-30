<?php

function connect()
{
    $servername = "localhost";
    $username = "HB";
    $password = getenv('DB_PASSWORD');
    $dbname = "heartbeats_logs*";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connexion failed :/" . $e->getMessage());
    }
    
    return $conn;
}

?>
