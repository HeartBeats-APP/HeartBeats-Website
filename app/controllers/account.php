<?php

class account extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('account/login');
    }

    public function login()
    {
        $this->header();
        $this->view('account/login');
    }

    public function register()
    {
        $this->header();
        $this->view('account/register');
    }

    public function user()
    {
        $this->header();
        $this->view('account/user');
    }

    public function admin()
    {
        $this->header();
        $this->view('account/admin');
    }

    public function password_recovery()
    {
        $this->header();
        $this->view('account/password-recovery');
    }


}