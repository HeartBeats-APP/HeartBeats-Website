<?php
require_once 'connect.php';
require_once 'ErrorsHandler.php';

class Moderation 
{
    const BAN_TRESHOLD = 10;

    public static function flagUser($email)
    {
        database_query("UPDATE moderation SET tokenNb = tokenNb + 1 WHERE mail = :mail", [":mail" => $email]);
        self::shouldUserBeBanned($email);
    }

    public static function unflagUser($email)
    {
        database_query("UPDATE moderation SET tokenNb = tokenNb - 1 WHERE mail = :mail", [":mail" => $email]);
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

    private static function shouldUserBeBanned($email)
    {
        $result = database_query("SELECT tokenNb, isBanned FROM moderation WHERE mail = :mail", [":mail" => $email]);
        if (!$result) {
            return;
        }

        $tokenNb = $result['tokenNb'];
        if ($tokenNb >= self::BAN_TRESHOLD && $result['isBanned'] == 0)
        {
            database_query("UPDATE moderation SET isBanned = 1 WHERE mail = :mail", [":mail" => $email]);
        }
    }
}