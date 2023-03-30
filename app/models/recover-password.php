<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];
$emailErrorMessage ;


if ($emailErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage
    ));
    return;
} 

// TODO: send email with a new password inside ; store the new password in the database.
// If the account doesn't exist, do nothing. Do not return an error message.

echo true;


?>

