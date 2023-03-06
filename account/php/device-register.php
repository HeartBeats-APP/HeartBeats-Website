<?php

$serialNumber = $_REQUEST['serial'];
$purshaseDate = $_REQUEST['date'];
$email = $_REQUEST['email'];

//TODO: register the device. If the device is already exist in the database ignore the request (and flag the user as dangerous because this behavior is suspicious)

echo true;

?>