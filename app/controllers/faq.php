<?php

class faq extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('faq/faq');
    }
}

?>