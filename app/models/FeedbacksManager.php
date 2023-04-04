<?php
session_start();
require_once 'connect.php';
require_once 'ErrorsHandler.php';

class FeedbacksManager
{
    const FAILED_TO_ADD_FEEDBACK = "Failed to add feedback in database";
    const GENERAL_ERROR = "Something went wrong on our side, please try again later";

    public function getFeedbacks()
    {
        return database_query("SELECT id, mail, title, message FROM feedbacks");
    }

    public function getNewFeedbacks()
    {
        return database_query("SELECT * FROM feedbacks WHERE isFeedbackRead = 0");
    }

    public function addFeedback($title, $message)
    {
        $previousNumber = $this->getNumberOfFeedbacks();
        database_query("INSERT INTO feedbacks (`mail`, `title`, `message`, `isFeedbackRead`) VALUES (:mail, :title, :message, DEFAULT)", [':mail' => $_SESSION['email'], ':title' => $title, ':message' => $message]);
        $currentNumber = $this->getNumberOfFeedbacks();

        if ($previousNumber + 1 == $currentNumber) {
            return true;
        }
        ErrorsHandler::newError(self::FAILED_TO_ADD_FEEDBACK, 2, true);
        return false;
    }

    public function deleteFeedback($id)
    {
        $previousNumber = $this->getNumberOfFeedbacks();
        database_query("DELETE FROM feedbacks WHERE id = :id", [':id' => $id]);
        $currentNumber = $this->getNumberOfFeedbacks();

        if ($previousNumber - 1 == $currentNumber) {
            return true;
        }
        ErrorsHandler::newError("Failed to delete feedback id $id from database", 2);
        return false;
    }

    public function markAsRead($id)
    {
        database_query("UPDATE feedbacks SET isFeedbackRead = 1 WHERE id = :id", [':id' => $id]);
    }

    public function markAllAsRead()
    {
        database_query("UPDATE feedbacks SET isFeedbackRead = 1");
    }


    private function getNumberOfFeedbacks()
    {
        $result =  database_query("SELECT COUNT(*) FROM feedbacks");
        return $result['COUNT(*)'];
    }
}