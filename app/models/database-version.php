<?php
require_once 'connect.php';
require_once 'errors-manager.php';
require_once 'userSession.php';

$GLOBALS['databaseLastVersion'] = 1.3;

function getDatabseLastVersion() {
    if (!isAnAdmin()) {
        newErrorMessage("A non-admin user tried to access the database version");
        return "Unknown";
    }
    return $GLOBALS['databaseLastVersion'];
}

function getDatabseVersion() {
    if (!isAnAdmin()) {
        newErrorMessage("A non-admin user tried to access the database version");
        return "Unknown";
    }
    $conn = connect();
    // Select the last row of the metadata table
    $stmt = $conn->prepare("SELECT `version` FROM metadata ORDER BY id DESC LIMIT 1");
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['version'];
}
