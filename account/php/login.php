<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$emailErrorMessage = checkEmailAdress($email, true);
$passwordErrorMessage = checkPassword($email, $password);

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage
    ));
    return;
} 

echo true;
// TODO: Log the user in


?>

