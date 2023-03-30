<?php
require_once 'connect.php';
require_once 'errors-manager.php';

function registerUser($name, $email, $password, $role)
{
    $conn = connect();
    // SQL request to register the user
    $stmt = $conn->prepare("INSERT INTO users (name, mail, password, role) VALUES (:name, :mail, :password, :role)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':role', $role);
    
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage()); 
        return;
    }

}

function isEmailExist($email)
{
    $conn = connect();
    $stmt = $conn->prepare("SELECT mail FROM users WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
