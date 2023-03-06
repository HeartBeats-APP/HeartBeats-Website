<?php
require_once 'entries-checker.php';

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$passwordConfirm = $_REQUEST['passwordConfirmation'];   
$zxcvbnSS = $_REQUEST['zxcvbnSS']; 

$emailErrorMessage = checkEmailAdress($email);
$nameErrorMessage = checkName($name);
$passwordErrorMessage = checkPasswordCreation($password, $zxcvbnSS);
$passwordConfirmErrorMessage = checkPasswordConfirmation($password, $passwordConfirm);

// TODO: check if the email is already used. If it is, write the error in $emailErrorMessage.

// TODO: register the user in the database. If it fails, return an error in either $emailErrorMessage or $passwordErrorMessage.

if ($emailErrorMessage != "" || $passwordErrorMessage != "" || $nameErrorMessage != "" || $passwordConfirmErrorMessage != ""){
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage,
        'nameErrorMessage' => $nameErrorMessage,
        'passwordConfirmErrorMessage' => $passwordConfirmErrorMessage
    ));
    return;
} 


echo true;


?>
