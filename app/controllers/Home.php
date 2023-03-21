<?php

class Home extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('index');
    }
}

?>