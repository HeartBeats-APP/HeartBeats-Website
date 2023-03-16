<?php
ini_set('session.gc_maxlifetime', 1800); // Session will expire after 30 minutes of inactivity
session_start();

require_once 'entries-checker.php';
require_once 'connect.php';


$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$stayConnected = $_REQUEST['stayConnected'];

$emailErrorMessage = checkEmailAdress($email);
$passwordErrorMessage = checkPasswordLogin($password);

if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
    echo json_encode(array(
        'emailErrorMessage' => $emailErrorMessage,
        'passwordErrorMessage' => $passwordErrorMessage
    ));
    return;
}

// Check if an account with this email exists
if (!isEmailExist($conn, $email)) {
    echo json_encode(array(
        'emailErrorMessage' => "There is no account with this email",
        'passwordErrorMessage' => ""
    ));
    return;
}

// Check if the password is correct
if (!verifyMailPasswordCombination($conn, $email, $password)) {
    echo json_encode(array(
        'emailErrorMessage' => "",
        'passwordErrorMessage' => "Incorrect password"
    ));
    return;
}

//Create a sesion for the user
loadUserDataToSession($conn, $email);



$conn = null;
echo true;







function verifyMailPasswordCombination($conn, $email, $entered_password)
{

    // Get the password from the database for the given email
    $stmt = $conn->prepare("SELECT password FROM tests WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashed_password = $result['password'];

    if (password_verify($entered_password, $hashed_password)) {
        return true;
    }

    return false;
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

function loadUserDataToSession($conn, $email)
{
    // Create a session to keep the user connected
    $_SESSION['email'] = $email;
    

    // Retrive user data from the database
    $stmt = $conn->prepare("SELECT name FROM tests WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $result['name'];
    
    // Retrive user data from the database
    $stmt = $conn->prepare("SELECT `device id`, `added date`, `device connected` FROM userdata WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $deviceID = $result['device id'];
    $addedDate = $result['added date'];
    $deviceConnected = $result['device connected'];
    
    $_SESSION['name'] = $name;
    $_SESSION['deviceID'] = $deviceID;
    $_SESSION['addedDate'] = $addedDate;
    $_SESSION['deviceConnected'] = $deviceConnected;

}
