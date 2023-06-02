<?php

class Legal extends Controller
{
    public function index()
    {
        $this->header();
        $this->view('legal/cgu');
        $this->footer();
    }

    public function cgu()
    {
        $this->header();
        $this->view('legal/cgu');
        $this->footer();
    }

    public function privacy()
    {
        $this->header();
        $this->view('legal/privacy');
        $this->footer();
    }

}