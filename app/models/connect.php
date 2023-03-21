<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/protected-computing/private-compute-core.php');


$servername = "localhost";
$username = "HB";
$password = GP();
$dbname = "heartbeats_logs*";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Database connexion failed :/". $e->getMessage());
}

?>