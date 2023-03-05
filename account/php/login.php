<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$stayConnected = $_REQUEST['stayConnected'];

$emailErrorMessage = checkEmailAdress($email, 'login');
$passwordErrorMessage = checkPasswordEmailCombination($email, $password);

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage
    ));
    return;
} 

// TODO: Log the user in
// TODO: If stayConnected is true, set a cookie
echo true;


?>

