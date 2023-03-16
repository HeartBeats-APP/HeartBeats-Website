<?php
session_start();
require_once 'entries-checker.php';
require_once 'connect.php';

// Getting the values from the form
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$passwordConfirm = $_REQUEST['passwordConfirmation'];
$zxcvbnSS = $_REQUEST['zxcvbnSS'];

// Checking the texts inputs (see in entries-checker.php)
$emailErrorMessage = checkEmailAdress($email);
$nameErrorMessage = checkName($name);
$passwordErrorMessage = checkPasswordCreation($password, $zxcvbnSS);
$passwordConfirmErrorMessage = checkPasswordConfirmation($password, $passwordConfirm);

// If an input is not valid, return the error message
if ($emailErrorMessage != "" || $passwordErrorMessage != "" || $nameErrorMessage != "" || $passwordConfirmErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage,
        'nameErrorMessage' => $nameErrorMessage,
        'passwordConfirmErrorMessage' => $passwordConfirmErrorMessage
    ));
    return;
}

// Checking if the email is already used
if (isEmailExist($conn, $email)) {
    echo json_encode(array(
        'emailErrorMessage' => 'This email is already used',
        'passwordErrorMessage' => '',
        'nameErrorMessage' => '',
        'passwordConfirmErrorMessage' => ''
    ));
    return;

 // If not, register the user
} else {
    $password = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
    registerUser($conn, $name, $email, $password);

    // Check if the user has been correctly registered
    if (!isEmailExist($conn, $email)) {
        echo json_encode(array(
            'emailErrorMessage' => "Cannot register the user",
            'passwordErrorMessage' => '',
            'nameErrorMessage' => '',
            'passwordConfirmErrorMessage' => ''
        ));
        return;
    }
}


$conn = null; // Closing the connection
echo true; // Returning true if everything is ok




function registerUser($conn, $name, $email, $password)
{

    // SQL request to register the user
    $stmt = $conn->prepare("INSERT INTO tests (name, mail, password) VALUES (:name, :mail, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':mail', $email);
    $stmt->execute();

    // Adding the user into other tables
    $stmt = $conn->prepare("INSERT INTO userdata (mail) VALUES (:mail)");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();

    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;

}

function isEmailExist($conn, $email)
{
    $stmt = $conn->prepare("SELECT mail FROM tests WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
