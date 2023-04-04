<?php
require_once 'connect.php';

class DatabaseManager {

    const SUPPORTED_DATABASE_VERSION = 1.5;
    const SUPPORTED_ENV_VERSION = 1.2;


    public function isUpToDate() {

        if ($this->getDatabaseVersion() == self::SUPPORTED_DATABASE_VERSION && $this->getEnvVersion()== self::SUPPORTED_ENV_VERSION) {
            return "Everything is up to date";
        }

        return "Some components need to be updated";
    }

    public function getUpdatesInfo() {
        $updates = array();
        $updates['current_db'] = $this->getDatabaseVersion();
        $updates['current_env'] = $this->getEnvVersion();
        $updates['supported_db'] = self::SUPPORTED_DATABASE_VERSION;
        $updates['supported_env'] = self::SUPPORTED_ENV_VERSION;

        return $updates;
    }


    private function getDatabaseVersion() {
        $version = database_query("SELECT `version` FROM metadata ORDER BY id DESC LIMIT 1");

        if (!$version){
            return 0;
        }

        return $version['version'];
    }

    private function getEnvVersion() {
        $version = getenv('ENV_VERSION');

        if (!$version){
            return 0;
        }
        return $version;
    }
        
}