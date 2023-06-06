<?php
require_once 'connect.php';
require_once 'ErrorsHandler.php';

class Moderation 
{
    const BAN_TRESHOLD = 9;

    public static function flagUser($email)
    {
        database_query("UPDATE moderation SET tokenNb = tokenNb + 1 WHERE mail = :mail", [":mail" => $email]);
        self::shouldUserBeBanned($email);
    }

    public static function unflagUser($email)
    {
        database_query("UPDATE moderation SET tokenNb = 0 WHERE mail = :mail", [":mail" => $email]);
        self::shouldUserBeBanned($email);
    }

    public static function isUserBanned($email)
    {
        $result = database_query("SELECT isBanned FROM moderation WHERE mail = :mail", [":mail" => $email]);
        if (!$result) {
            return false;
        }

        return ($result['isBanned'] == 1);
    }

    public static function getFlagsNumber($email)
    {
        $result = database_query("SELECT tokenNb FROM moderation WHERE mail = :mail", [":mail" => $email]);
        if (!$result) {
            return 0;
        }

        return $result['tokenNb'];
    }

    private static function shouldUserBeBanned($email)
    {
        $result = database_query("SELECT tokenNb, isBanned FROM moderation WHERE mail = :mail", [":mail" => $email]);
        if (!$result) {
            return;
        }

        $tokenNb = $result['tokenNb'];
        if ($tokenNb > self::BAN_TRESHOLD)
        {
            database_query("UPDATE moderation SET isBanned = 1 WHERE mail = :mail", [":mail" => $email]);
        }
    }

    public static function banUser($email)
    {
        if (AccountManager::isThisUserAdmin($email)) {
            return;
        }

        $result = database_query("SELECT * FROM users WHERE mail = :mail", [":mail" => $email]);
        if (!$result) {
            database_query("INSERT INTO users (mail) VALUES (:mail)", [":mail" => $email]);
        }
        
        database_query("UPDATE moderation SET isBanned = 1 WHERE mail = :mail", [":mail" => $email]);
    }

    public static function unbanUser($email)
    {
        database_query("UPDATE moderation SET isBanned = 0 WHERE mail = :mail", [":mail" => $email]);
    }
}