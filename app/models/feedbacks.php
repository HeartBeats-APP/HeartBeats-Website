<?php
require_once 'errors-manager.php';
require_once 'connect.php';
require_once 'userSession.php';

function storeFeedback($title, $message)
{
    require_once 'connect.php';
    require_once 'userSession.php';
    $conn = connect();

    $stmt = $conn->prepare("INSERT INTO feedbacks (mail, title, message) VALUES (:email, :title, :message)");
    $stmt->bindParam(':email', getMail());
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':message', $message);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    if ($stmt->rowCount() == 1) {
        return true;
    } else {
        return false;
        newErrorMessage("Feedback could  not be stored despite the absence of errors");
    }
}
?>