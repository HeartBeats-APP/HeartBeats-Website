<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/InputValidator.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/FeedbacksManager.php');


class contact extends Controller
{
    public function index()
    {   
        //check if user is logged in
        if (!AccountManager::isSessionActive()) {
            header('Location: /account/login');
            return;
        }

        $this->header();
        $this->view('contact/contact');
        $this->footer();
    }

    public function getFeedback()
    {
        $title = $_REQUEST['title'];
        $message = $_REQUEST['message'];

        $inputValidator = new TextInput;
        $titleResult = $inputValidator->validate($title, 5, 50);
        $messageResult = $inputValidator->validate($message, 10, 500);

        if ($titleResult || $messageResult) {
            echo json_encode(array('result' => 'InputsError', 'titleErrorMessage' => $titleResult, 'messageErrorMessage' => $messageResult));
            return;
        }

        $feedbacksManager = new FeedbacksManager;
        $result = $feedbacksManager->addFeedback($title, $message);

        if ($result) {
            echo true;
            return;
        } 

        echo false;
    }

}
