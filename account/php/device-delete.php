<?php
session_start();
require_once 'connect.php';

$email = $_REQUEST['email'];

if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION['email'] == $email)) {
    echo json_encode(array(
        'errorMessage' => 'You are not logged in'
    ));
    return;
}

// Delete the device from the database
$stmt = $conn->prepare("UPDATE userdata SET `device id` = NULL, `added date` = NULL, `device connected` = NULL, `device mode` = NULL WHERE mail = :mail");
$stmt->bindParam(':mail', $email);
$stmt->execute();

// Update the session
$_SESSION['deviceID'] = "";
$_SESSION['addedDate'] = "";
$_SESSION['deviceConnected'] = "";
$_SESSION['deviceMode'] = "";

echo true;

?>