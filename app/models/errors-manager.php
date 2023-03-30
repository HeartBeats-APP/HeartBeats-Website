<?php
require_once 'userSession.php';
require_once 'connect.php';

function newErrorMessage($errorMessage)
{
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO logs `message`, `severity` VALUES (:message, :severity)");
    $stmt->bindParam(':message', 'ERROR: ' . $errorMessage);
    $stmt->bindParam(':severity', 'Low');
    $stmt->execute();


    if (!isDebugMode()){
        echo "Something went wrong on our side, please try again later.";
        return;
    }

    echo $errorMessage;
}

function newWarningMessage($warningMessage)
{
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO logs `message`, `severity` VALUES (:message, :severity)");
    $stmt->bindParam(':message', 'WARNING: ' . $warningMessage);
    $stmt->bindParam(':severity', 'Medium');
    $stmt->execute();

}

function CriticalMessage($Message)
{
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO logs `message`, `severity` VALUES (:message, :severity)");
    $stmt->bindParam(':message', 'CRITIC: ' . $Message);
    $stmt->bindParam(':severity', 'High');
    $stmt->execute();

}
