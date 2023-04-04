<?php
require_once 'ErrorsHandler.php';

function connect()
{
    $servername = "localhost";
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connexion failed :/" . $e->getMessage());
    }
    
    return $conn;
}

function database_query($query, $params = [])
{
    $conn = connect();
    $stmt = $conn->prepare($query);
    try {
        $stmt->execute($params);
    } catch (PDOException $e) {
        ErrorsHandler::newError($e->getMessage(), 2, true);
        return null;
    }

    $rowCount = $stmt->rowCount();
    if ($rowCount == 1) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else if ($rowCount > 1) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return null; // No rows returned
    }
}

?>
