<?php
require_once 'connect.php';
require_once 'ErrorsHandler.php';

class QAManager
{
    public function getFAQ()
    {
        return database_query("SELECT id, question, answer FROM `q&a`");
    }

    public function updateFAQ($data){

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]->id;
            $question = $data[$i]->question;
            $answer = $data[$i]->answer;

            database_query("UPDATE `q&a` SET question = :question, answer = :answer WHERE id = :id", [':question' => $question, ':answer' => $answer, ':id' => $id]);
        }

        return true;
    }


    private function getNumberOfQuestions()
    {
        return database_query("SELECT COUNT(*) FROM q&a");
    }
}