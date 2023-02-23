<?php
require_once 'entries-checker.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$emailErrorMessage = getPotentialEmailErrorMessage($email);
$passwordErrorMessage = getPotentialPasswordErrorMessage($password);

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage
    ));
    return;
} 

echo true;
// TODO: Log the user in




function getPotentialEmailErrorMessage($email) {
    // Check if the email is not empty
    if (isFieldEmpty($email)) {
        return "This field can't be empty";
    }

    // Check if the email is valid
    if (!checkEmailAdress($email)) {
        return "Please enter a valid email address";
    }

    // Check if the email exist in database
    // TODO

    return "";
}

function getPotentialPasswordErrorMessage($password) {
    // Check if the password is not empty
    if (isFieldEmpty($password)) {
        return "This field can't be empty";
    }

    // Check if the password match with the one in database
    // TODO

    return "";
}

?>

