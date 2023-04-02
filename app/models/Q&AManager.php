<?php
require_once 'connect.php';
require_once 'ErrorsHandler.php';

class QAManager
{
    public function getFAQ()
    {
        return database_query("SELECT id, question, answer FROM q&a");

    }

    public function addQuestion($question, $answer)
    {   
        $previousNumber = $this->getNumberOfQuestions();
        database_query("INSERT INTO q&a (`date`,`question`, `answer`) VALUES (DEFAULT, :question, :answer)", [':question' => $question, ':answer' => $answer]);
        $currentNumber = $this->getNumberOfQuestions();

        if ($previousNumber + 1 == $currentNumber) {
            return true;
        } 
        ErrorsHandler::newError("Failed to add question in database", 2);
    }

    public function deleteQuestion($id)
    {
        $previousNumber = $this->getNumberOfQuestions();
        database_query("DELETE FROM q&a WHERE id = :id", [':id' => $id]);
        $currentNumber = $this->getNumberOfQuestions();

        if ($previousNumber - 1 == $currentNumber) {
            return true;
        }
        ErrorsHandler::newError("Failed to delete question id $id from database", 2);
    }

    private function getNumberOfQuestions()
    {
        return database_query("SELECT COUNT(*) FROM q&a");
    }
}