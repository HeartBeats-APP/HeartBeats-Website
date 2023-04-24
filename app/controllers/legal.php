<?php

class Legal extends Controller
{
    public function index($page = 'cgu')
    {
        $this->header();
        if ($page = 'cgu')
        {
            $this->view('legal/' . $page);

        }
        $this->footer();
    }


}