<?php
require_once "AccountManager.php";
require_once "Moderation.php";

class SearchEngine
{

    public function search($searchQuery)
    {
        $searchQuery = "%$searchQuery%";
        $results = database_query("SELECT * FROM `users` WHERE `name` LIKE :searchQuery OR `mail` LIKE :searchQuery OR `id` LIKE :searchQuery", [
            ":searchQuery" => $searchQuery
        ]);

        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['isBanned'] = Moderation::isUserBanned($results[$i]['mail']);
            $results[$i]['tokenNb'] = Moderation::getFlagsNumber($results[$i]['mail']);
            $results[$i]['isAdmin'] = AccountManager::isThisUserAdmin($results[$i]['mail']);
            $results[$i]['isConfirmed'] = (new Confirmation)->isAccountConfirmed($results[$i]['mail']);
        }

        return $results;
    }
}
