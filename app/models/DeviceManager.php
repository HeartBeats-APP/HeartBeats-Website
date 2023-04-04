<?php
require_once 'connect.php';
session_start();

class DeviceManager
{   
    const GENERAL_ERROR = "Something went wrong on our side, please try again later";
    const DEVICE_EXISTS_ERROR = "You already own a device";
    const DEVICE_NOT_EXISTS_ERROR = "Device doesn't exists";

    public static function isDeviceExists()
    {
        $mail = $_SESSION['email'];
        $result = database_query("SELECT `mail`, `device id` FROM userdata WHERE mail = :mail", [':mail' => $mail]);
        if ($result['mail'] == $mail && $result['device id'] != null) {
            return true;
        } else {
            return false;
        }
    }

    public static function getDeviceData()
    {
        return database_query("SELECT `device id`, `added date`, `device mode`, `isDeviceConnected` FROM userdata WHERE mail = :mail", [':mail' => $_SESSION['email']]);
    }
}

class Device extends DeviceManager
{
    public function addNew($serialNumber, $addedDate)
    {   
        if ($this->isDeviceExists()) {
            return self::DEVICE_EXISTS_ERROR;
        }

        $mail = $_SESSION['email'];
        database_query("INSERT INTO userdata (mail, `device id`, `added date`, `device mode`, `isDeviceConnected`) VALUES (:mail, :deviceid, :addeddate, DEFAULT, DEFAULT)", [':mail' => $mail, ':deviceid' => $serialNumber, ':addeddate' => $addedDate]);

        if ($this->isDeviceExists($mail)) {
            return "";
        } 

        echo self::GENERAL_ERROR;
    }

    public function remove()
    {
        $mail = $_SESSION['email'];
        database_query("DELETE FROM userdata WHERE mail = :mail", [':mail' => $mail]);

        if (!$this->isDeviceExists($mail)) {
            return "";
        } 

        echo self::GENERAL_ERROR;
    }

    public function updateMode($deviceMode)
    {
        database_query("UPDATE userdata SET `device mode` = :devicemode WHERE mail = :mail", [':devicemode' => $deviceMode, ':mail' => $_SESSION['email']]);
        return true;
    }

    public function updateConnectionStatus($isDeviceConnected)
    {
        database_query("UPDATE userdata SET `isDeviceConnected` = :isdeviceconnected WHERE mail = :mail", [':isdeviceconnected' => $isDeviceConnected, ':mail' => $_SESSION['email']]);
        return true;
    }

    public function getMode()
    {
        return database_query("SELECT `device mode` FROM userdata WHERE mail = :mail", [':mail' => $_SESSION['email']]);
    }

    public function getConnectionStatus()
    {
        return database_query("SELECT `isDeviceConnected` FROM userdata WHERE mail = :mail", [':mail' => $_SESSION['email']]);
    }

}
