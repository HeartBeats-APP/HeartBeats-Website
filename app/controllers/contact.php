<?php

class contact extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('contact/contact');
    }
}