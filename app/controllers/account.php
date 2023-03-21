<?php

class account extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('account/login.php');
    }
}