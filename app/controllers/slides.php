<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');

class Slides extends Controller
{

    public function index()
    {
        $this->header();
        if (AccountManager::isSessionActive() && AccountManager::isAdmin() )
        {
            $this->view('slides');      
        } else {
            $this->account();
        }

    }

}
