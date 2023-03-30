<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/userSession.php');

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
        if (isSessionActive() && getRole() == "admin") {
            $AccountText = "Admin";
            $AccountAction = "admin";
        } else if (isSessionActive()) {
            $AccountText = "Account";
            $AccountAction = "user";
        } else {
            $AccountText = "Login";
            $AccountAction = "login";
        }

        require_once '../app/views/components/header.php';
    }

    public function account($data = [], $destination = "")
    {
        $this->header();

        if (isSessionActive() && getRole() == "admin" && $destination == "admin") {
            $data = $this->addAdminData($data);
            $this->view('account/admin', $data);
        } else if (isSessionActive()) {
            $this->view('account/user', $data);
        } else {
            $this->view('account/login');
        }
    }

    private function addAdminData($data)
    {
        $data['debugMode'] = isDebugMode();
        return $data;
    }
}
