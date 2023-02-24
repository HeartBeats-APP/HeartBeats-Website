<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];

$emailErrorMessage = checkEmailAdress($email, false);

if ($emailErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage
    ));
    return;
} 

echo true;
// TODO: send email with link to reset password


?>

