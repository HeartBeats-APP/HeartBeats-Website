<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$stayConnected = $_REQUEST['stayConnected'];

$emailErrorMessage = checkEmailAdress($email);

// TODO: check if the mail exists in the database. If it doesn't, write the error in $emailErrorMessage.

// TODO: If mail/password combination match, log the user in in the database. Else, return an error message in $passwordErrorMessage.
$passwordErrorMessage = "";

// TODO: When the user is being loged, store the time of the login in the database for later use.

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage
    ));
    return;
} 


echo true;


?>

