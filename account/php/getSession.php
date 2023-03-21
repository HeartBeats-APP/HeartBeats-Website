<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_REQUEST['email'];

if (session_status() === PHP_SESSION_ACTIVE && $_SESSION['email'] == $email) {
    echo json_encode(array(
        'email' => $_SESSION['email'],
        'name' => $_SESSION['name'],
        'deviceID' => $_SESSION['deviceID'],
        'addedDate' => $_SESSION['addedDate'],
        'deviceConnected' => $_SESSION['deviceConnected']
    ));
    return;
} 

echo false;


?>