<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/DatabaseManager.php');

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
        //$data will be available in the view without any extra code needed
    }

    public function header()
    {
        if (AccountManager::isAdmin()) {
            $AccountText = "Admin";
            $AccountAction = "admin";
        } else if (AccountManager::isSessionActive()) {
            $AccountText = "Account";
            $AccountAction = "user";
        } else {
            $AccountText = "Login";
            $AccountAction = "login";
        }

        require_once '../app/views/components/header.php';
    }

    public function footer()
    {
        require_once '../app/views/components/footer.php';
    }

    public function account($data = [], $destination = "")
    {
        $this->header();

        if (AccountManager::isAdmin() && $destination == "admin") {
            $data = $this->addAdminData($data);
            $this->view('account/admin', $data);
        } else if (AccountManager::isSessionActive()) {
            $this->view('account/user', $data);
        } else {
            $this->view('account/login');
        }
    }

    private function addAdminData($data)
    {   
        $Database = new DatabaseManager;
        $data['updates'] = $Database->isUpToDate();
        $data['debugMode'] = (new DebugMode)->isDebugModeActive();

        return $data;
    }
}
