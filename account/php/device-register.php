<?php
session_start();
require_once 'entries-checker.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/protected-computing/private-compute-core.php');
require_once 'connect.php';

$serialNumber = $_REQUEST['serial'];
$purshaseDate = $_REQUEST['date'];
$email = $_REQUEST['email'];
$serialNumberErrorMessage;


// Security layers
$serialNumberErrorMessage = IFS($serialNumber);
$serialNumberErrorMessage = INF($serialNumber);

if ($serialNumberErrorMessage != "") {
    echo json_encode(array(
        'errorMessage' => $serialNumberErrorMessage
    ));
    return;
}

if (isFieldEmpty($serialNumber) || isFieldEmpty($purshaseDate) || isFieldEmpty($email)) {
    echo json_encode(array(
        'errorMessage' => 'Please fill all the fields'
    ));
    return;
}


// Check if the user is logged in
if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION['email'] == $email)) {
    echo json_encode(array(
        'errorMessage' => 'You are not logged in    '
    ));
    return;
}

// Send the data using sql query
$stmt = $conn->prepare("UPDATE userdata SET `device id` = :serialNumber, `added date` = :purshaseDate, `device connected` = 'true', `device mode` = 'normal' WHERE mail = :mail");
$stmt->bindParam(':mail', $email);
$stmt->bindParam(':serialNumber', $serialNumber);
$stmt->bindParam(':purshaseDate', $purshaseDate);
$stmt->execute();

// Update the session
$_SESSION['deviceID'] = $serialNumber;
$_SESSION['addedDate'] = $purshaseDate;
$_SESSION['deviceConnected'] = 'true';
$_SESSION['deviceMode'] = 'normal';

echo true;

?>