<?php

class Home extends Controller
{
    public function index()
    {
        $this->view('components/header');
        $this->view('index');
    }
}

?>