<?php
require_once 'connect.php';

class DatabaseManager {

    const SUPPORTED_DATABASE_VERSION = 1.4;
    const SUPPORTED_ENV_VERSION = 1.2;

    protected $currentDatabaseVersion;
    protected $currentEnvVersion;

    public function __construct() {
        $this->currentDatabaseVersion = $this->getDatabaseVersion();
        $this->currentEnvVersion = $this->getEnvVersion();
    }

    public function update() {
        $this->updateDatabaseVersion();
        $this->updateEnvVersion();
    }

    public function getDatabaseVersion() {
        return $this->currentDatabaseVersion;
    }

    public function getEnvVersion() {
        return $this->currentEnvVersion;
    }

    public function isUpToDate() {
        $messageArray = [];

        if ($this->currentDatabaseVersion == self::SUPPORTED_DATABASE_VERSION) {
            $messageArray['database'] = "Database is up to date";
        } else if ($this->currentDatabaseVersion < self::SUPPORTED_DATABASE_VERSION) {
            $messageArray['database'] = "Database can be updated to version " . self::SUPPORTED_DATABASE_VERSION;
        } else {
            $messageArray['database'] = "Database version " . $this->currentDatabaseVersion . " is not supported yet ";
        }

        if ($this->currentEnvVersion == self::SUPPORTED_ENV_VERSION) {
            $messageArray['env'] = "Environment variables are up to date";
        } else if ($this->currentEnvVersion < self::SUPPORTED_ENV_VERSION) {
            $messageArray['env'] = "Environment variables can be updated to version " . self::SUPPORTED_ENV_VERSION;
        } else {
            $messageArray['env'] = "Environment variables version " . $this->currentEnvVersion . " are not supported yet ";
        }

        return $messageArray;
    }

    private function updateDatabaseVersion() {
        $version = database_query("SELECT `version` FROM metadata ORDER BY id DESC LIMIT 1");

        if (!$version){
            return 0;
        }
        return $version['version'];
    }

    private function updateEnvVersion() {
        $version = getenv('ENV_VERSION');

        if (!$version){
            return 0;
        }
        return $version;
    }
        
}