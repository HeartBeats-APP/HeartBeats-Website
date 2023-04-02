<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/Q&AManager.php');

class faq extends Controller
{
    public function index()
    {   
        $this->header();
        $this->view('faq/faq');
    }
}

?>