<?php

class dashboard extends Controller
{
    public function index()
    {
        $data = getSessionData();
        $this->header();
        $this->view('dashboard/dashboard', $data);
    }

    
}