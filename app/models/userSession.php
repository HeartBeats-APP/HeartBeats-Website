<?php
ini_set('session.gc_maxlifetime', 1800); // Session will expire after 30 minutes of inactivity
session_start();

function loadUserSession($email)
{
    require_once 'connect.php';
    $conn = connect();

    // Retrive user data from the database
    $stmt = $conn->prepare("SELECT `name`, `role` FROM users WHERE mail = :mail");
    $stmt->bindParam(':mail', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['email'] = $email;
    $_SESSION['name'] = $result['name'];
    $_SESSION['role'] = $result['role'];
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

    $stmt = $conn->prepare("SELECT `device id` FROM userdata WHERE mail = :mail");
    $stmt->bindParam(':mail', $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['device id'] == null) {
        return false;
    } else {
        return true;
    }
}

function getDeviceData()
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("SELECT `device id`, `added date`, `device connected` FROM userdata WHERE mail = :mail");
    $stmt->bindParam(':mail', $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return array(
        'device id' => $result['device id'],
        'added date' => $result['added date'],
        'device connected' => $result['device connected']
    );
}

function addDevice($serialNumber, $addedDate)
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("UPDATE userdata SET `device id` = :serialNumber, `added date` = :addedDate, `device connected` = 'true', `device mode` = 'normal'  WHERE mail = :mail");
    $stmt->bindParam(':serialNumber', $serialNumber);
    $stmt->bindParam(':addedDate', $addedDate);
    $stmt->bindParam(':mail', $_SESSION['email']);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}

function removeDevice()
{
    require_once 'connect.php';
    $conn = connect();

    $stmt = $conn->prepare("UPDATE userdata SET `device id` = NULL, `added date` = NULL, `device connected` = NULL, `device connected` = NULL, `device mode` = NULL WHERE mail = :mail");
    $stmt->bindParam(':mail', $_SESSION['email']);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
