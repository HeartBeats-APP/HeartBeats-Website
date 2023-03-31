<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/userSession.php');

class contact extends Controller
{
    public function index()
    {   
        //check if user is logged in
        if (!isSessionActive()) {
            header('Location: /account/login');
            return;
        }

        $this->header();
        $this->view('contact/contact');
    }

    public function getFeedback()
    {
        $title = $_REQUEST['title'];
        $message = $_REQUEST['message'];
        $titleErrorMessage = $this->checkInput($title, 5, 50);
        $messageErrorMessage = $this->checkInput($message, 10, 1000);

        if ($titleErrorMessage != "" || $messageErrorMessage != "") {
            echo json_encode(array(
                'titleErrorMessage' => $titleErrorMessage,
                'messageErrorMessage' => $messageErrorMessage
            ));
            return;
        }


        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/feedbacks.php');
        $result = storeFeedback($title, $message);

        if ($result) {
            echo true;
            return;
        } 

        echo json_encode(array(
            'Error' => "Something went wrong on our side. Please try again later.",
        ));
    }

    private function checkInput($input, $min, $max)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        if (strlen($input) < $min) {
            return "This field must be at least $min characters long";
        } else if (strlen($input) > $max) {
            return "This field must be at most $max characters long";
        }

        return "";
    }
}
