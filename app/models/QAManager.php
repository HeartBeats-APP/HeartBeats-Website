<?php
require_once 'connect.php';
require_once 'ErrorsHandler.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');

class QAManager
{
    public function getFAQ()
    {
        return database_query("SELECT id, question, answer FROM `q&a`");
    }

    public function updateFAQ($data){

        if (empty($data)) {
            $debugMode = new debugMode();
            if ($debugMode->isDebugModeActive()) {
                echo "Incoming data is empty and cannot be processed";
            } else {
                echo "Something went wrong";
            }
            return false;
        }
        $this->wipeFAQ();

        foreach ($data as $QA) {
            $id = $QA->id;
            $question = $QA->question;
            $answer = $QA->answer;

            database_query("INSERT INTO `q&a` (id, question, answer) VALUES (:id, :question, :answer)", [
                ":id" => $id,
                ":question" => $question,
                ":answer" => $answer
            ]);
        }

        return true;
    }

    private function wipeFAQ()
    {
        database_query("TRUNCATE TABLE `q&a`");
    }

    private function getNumberOfQuestions()
    {
        return database_query("SELECT COUNT(*) FROM q&a");
    }
}