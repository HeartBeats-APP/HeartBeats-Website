<?php

function storeFeedback($title, $message)
{
    require_once 'connect.php';
    require_once 'userSession.php';
    $conn = connect();

    $stmt = $conn->prepare("INSERT INTO feedbacks (mail, title, message) VALUES (:email, :title, :message)");
    $stmt->bindParam(':email', getMail());
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}
?>