<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/QAManager.php');

class faq extends Controller
{
    public function index()
    {   
        $QAManager = new QAManager;
        $data = $QAManager->getFAQ();
        
        $this->header();
        $this->view('faq/faq', $data);
        $this->footer();
    }
}

?>