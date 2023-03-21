<?php

class dashboard extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('dashboard/dashboard');
    }
}