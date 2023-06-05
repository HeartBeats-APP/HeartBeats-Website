<?php

class SearchEngine
{

    public function search($searchQuery)
    {
        $searchQuery = "%$searchQuery%";
        return database_query("SELECT * FROM `users` WHERE `name` LIKE :searchQuery OR `mail` LIKE :searchQuery OR `id` LIKE :searchQuery", [
            ":searchQuery" => $searchQuery
        ]);


    }
}
