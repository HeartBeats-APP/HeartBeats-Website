<?php
session_start();
require_once 'connect.php';

class ErrorsHandler {

    const GENERAL_ERROR = "Something went wrong on our side, please try again later.";

    public static function newError($message, $severity = 1, $echo = false) {
        database_query("INSERT INTO logs (time, mail, message, severity, isLogRead) VALUES (DEFAULT, :mail, :message, :severity, DEFAULT)", [':mail' => $_SESSION['email'], ':message' => $message, ':severity' => $severity]);
    
        if ($echo) {
            self::echoError($message);
        }
    }
    
    public static function getAllErrors() {
        return database_query("SELECT * FROM logs");
    }
    
    public static function getNewErrors() {
        return database_query("SELECT * FROM logs WHERE isLogRead = 0");
    }

    public static function markAsRead($id) {
        database_query("UPDATE logs SET isLogRead = 1 WHERE id = :id", [':id' => $id]);
    }

    public static function markAllAsRead() {
        database_query("UPDATE logs SET isLogRead = 1");
    }

    private static function echoError($message) {
        if ($_SESSION['debugMode'] && $_SESSION['role'] == "admin") {
            echo $message;
            return;
        } 
        echo self::GENERAL_ERROR;
    }

}
