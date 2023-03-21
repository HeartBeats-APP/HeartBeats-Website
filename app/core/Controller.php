<?php

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
        //$data will be available in the view
    }

    public function header()
    {
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == true)
        {
            $AccountText = "Account";
            $AccountAction = "user";
        } else {
            $AccountText = "Login";
            $AccountAction = "login";
        }

        require_once '../app/views/components/header.php';
    }
}

?>
