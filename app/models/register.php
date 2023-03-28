<?php
require_once 'connect.php';

function registerUser($name, $email, $password, $role)
{
    $conn = connect();
    // SQL request to register the user
    $stmt = $conn->prepare("INSERT INTO users (name, mail, password, role) VALUES (:name, :mail, :password, :role)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    // Adding the user into other tables
    $stmt = $conn->prepare("INSERT INTO userdata (mail) VALUES (:mail)");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
}

function isEmailExist($email)
{
    $conn = connect();
    $stmt = $conn->prepare("SELECT mail FROM users WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
