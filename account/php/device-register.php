<?php
require_once 'entries-checker.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/protected-computing/private-compute-core.php');

$serialNumber = $_REQUEST['serial'];
$purshaseDate = $_REQUEST['date'];
$email = $_REQUEST['email'];
$serialNumberErrorMessage;


// Security layers
$serialNumberErrorMessage = IFS($serialNumber);
$serialNumberErrorMessage = INF($serialNumber);

if (isFieldEmpty($serialNumber)) {
    $serialNumberErrorMessage = "This field can't be empty";
}

if ($serialNumberErrorMessage != "") {
    echo json_encode(array(
        'serialNumberErrorMessage' => $serialNumberErrorMessage
    ));
    return;
}

//TODO: register the device. If the device is already exist in the database ignore the request (and flag the user as dangerous because this behavior is suspicious)

echo true;

?>