<?php
require_once 'connect.php';
require_once 'errors-manager.php';

function isPasswordCorrect($email, $entered_password)
{   
    $conn = connect();
    // Get the password from the database for the given email
    $stmt = $conn->prepare("SELECT password FROM users WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashed_password = $result['password'];
    if (password_verify($entered_password, $hashed_password)) {
        return true;
    }

    return false;
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


?>