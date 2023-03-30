<?php
ini_set('session.gc_maxlifetime', 1800); // Session will expire after 30 minutes of inactivity
session_start();
require_once 'errors-manager.php';

function loadUserSession($email)
{
    require_once 'connect.php';
    $conn = connect();

    // Retrive user data from the database
    $stmt = $conn->prepare("SELECT `name`, `role`, `debugMode` FROM users WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $result['name'];
    $_SESSION['role'] = $result['role'];
    $_SESSION['debugMode'] = $result['debugMode'];
}

function createSession($email)
{
    ini_set('session.gc_maxlifetime', 1800); // Session will expire after 30 minutes of inactivity
    session_start();
    loadUserSession($email);
}

function destroySession()
{
    session_start();
    session_unset();
    session_destroy();
}

function isSessionActive()
{
    return session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['role']);
}

function isSessionDataExist()
{
    return isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['role']);
}


function getSessionData()
{
    return array(
        'email' => $_SESSION['email'],
        'name' => $_SESSION['name'],
        'role' => $_SESSION['role']
    );
}

function getRole()
{
    return $_SESSION['role'];
}

function getMail()
{
    return $_SESSION['email'];
}

function hasADevice()
{
    require_once 'connect.php';
    $conn = connect();

    // Check if the mail exist in the database
    $stmt = $conn->prepare("SELECT mail FROM userdata");

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        if ($row['mail'] == $_SESSION['email']) {
            return true;
        }
    }
    return false;
}

function getDeviceData()
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("SELECT `device id`, `added date`, `isDeviceConnected` FROM userdata WHERE mail = :mail");
    $stmt->bindParam(':mail', $_SESSION['email']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return array(
        'device id' => $result['device id'],
        'added date' => $result['added date'],
        'device connected' => $result['isDeviceConnected']
    );
}

function addDevice($serialNumber, $addedDate)
{
    require_once 'connect.php';
    $conn = connect();

    //create a new row
    $stmt = $conn->prepare("INSERT INTO userdata (mail, `device id`, `added date`) VALUES (:mail, :deviceid, :addeddate)");
    $stmt->bindParam(':mail', $_SESSION['email']);
    $stmt->bindParam(':deviceid', $serialNumber);
    $stmt->bindParam(':addeddate', $addedDate);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }
    
}

function removeDevice()
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("DELETE FROM userdata WHERE mail = :mail");
    $stmt->bindParam(':mail', $_SESSION['email']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
    }
}

function debugMode($value) 
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("UPDATE users SET `debugMode` = :value WHERE mail = :mail");
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':mail', $_SESSION['email']);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $_SESSION['debugMode'] = $value;
}

function isDebugMode()
{
    return $_SESSION['debugMode'] && $_SESSION['role'] == 'admin';
}
