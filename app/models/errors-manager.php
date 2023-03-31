<?php
require_once 'userSession.php';
require_once 'connect.php';

function newErrorMessage($errorMessage)
{   
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO logs (`time`, `message`, `severity`, `isLogRead`) VALUES (DEFAULT, :message, :severity, DEFAULT)");
    $message = 'ERROR: ' . $errorMessage;
    $severity = 'Low';
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':severity', $severity);
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
    $stmt = $conn->prepare("INSERT INTO logs (`time`, `message`, `severity`, `isLogRead`) VALUES (DEFAULT, :message, :severity, DEFAULT)");
    $message = 'WARNING: ' . $warningMessage;
    $severity = 'Medium';
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':severity', $severity);
    $stmt->execute();


}

function CriticalMessage($Message)
{
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO logs (`time`, `message`, `severity`, `isLogRead`) VALUES (DEFAULT, :message, :severity, DEFAULT)");
    $message = 'CRITICAL: ' . $Message;
    $severity = 'High';
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':severity', $severity);
    $stmt->execute();

}
