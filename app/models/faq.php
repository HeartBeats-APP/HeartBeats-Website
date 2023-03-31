<?php
require_once 'connect.php';
require_once 'errors-manager.php';

function getFAQ() {

    $conn = connect();
    $stmt = $conn->prepare("SELECT `question`, `answer` FROM q&a");

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function addQuestion($question, $answer) {
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO q&a (`question`, `answer`) VALUES (:question, :answer)");
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':answer', $answer);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }
}

function deleteQuestion($id) {
    $conn = connect();
    $stmt = $conn->prepare("DELETE FROM q&a WHERE id = :id");
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        newErrorMessage($e->getMessage());
        return;
    }
}

