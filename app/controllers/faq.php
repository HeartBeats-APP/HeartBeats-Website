<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/faq.php');

class faq extends Controller
{
    public function index()
    {   
        $this->header();
        $this->view('faq/faq');
    }
}

?>