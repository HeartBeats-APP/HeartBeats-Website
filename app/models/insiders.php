<?php
require_once 'errors-manager.php';

function getInsidersList()
{
    $conn = connect();
    $stmt = $conn->prepare("SELECT email FROM preco");

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}