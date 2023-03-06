<?php

$email = $_REQUEST['email'];

//TODO: If this user has a device registered, return the serial number and the purchase date (both as string). Else, return false.
$serialNumber = "" ;
$purshaseDate = "" ;

if ($serialNumber != "" && $purshaseDate != "") {
    echo json_encode(array(
        'serialNumber' => $serialNumber,
        'purshaseDate' => $purshaseDate
    ));
    return;
}

echo false;

?>