<?php

function getInsidersList()
{
    $conn = connect();
    $stmt = $conn->prepare("SELECT email FROM preco");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}