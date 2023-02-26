<?php
require_once 'entries-checker.php';

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$passwordConfirm = $_REQUEST['passwordConfirmation'];   
$zxcvbnSS = $_REQUEST['zxcvbnSS']; 

$emailErrorMessage = checkEmailAdress($email, 'register');
$nameErrorMessage = checkName($name);
$passwordErrorMessage = checkPasswordCreation($password, $zxcvbnSS);
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
