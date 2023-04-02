<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');

class dashboard extends Controller
{
    public function index()
    {
        $data = AccountManager::getSessionData();
        $this->header();
        $this->view('dashboard/dashboard', $data);
    }

    
}