<?php
require_once 'entries-checker.php';

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$passwordConfirm = $_REQUEST['passwordConfirmation'];    

$emailErrorMessage = checkEmailAdress($email, true);
$passwordErrorMessage = checkPassword($email, $password);
$nameErrorMessage = checkName($name);
$passwordConfirmErrorMessage = checkPasswordConfirmation($password, $passwordConfirm);

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage,
        'nameErrorMessage' => $nameErrorMessage,
        'passwordConfirmErrorMessage' => $passwordConfirmErrorMessage
    ));
    return;
} 

echo true;
// TODO: register the user


?>
