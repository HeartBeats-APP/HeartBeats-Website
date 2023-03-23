<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/protected-computing/private-compute-core.php');

$title = $_REQUEST['title'];
$message = $_REQUEST['message'];

$titleError = checkErrorInText($title, 5, 100);
$messageError = checkErrorInText($message, 10, 1000);

if ($titleError != "" || $messageError != "") {
    echo json_encode(array(
        'titleError' => $titleError,
        'messageError' => $messageError
    ));
    return;
}

//TODO: send the feedback to the database

echo true;
return;

function checkErrorInText($text, $minLength, $maxLength)
{
    // Check if the text is not empty
    if (isFieldEmpty($text)) {
        return "This field can't be empty";
    }

    // Check if the text is not too short
    if (strlen($text) < $minLength) {
        return "The text is too short";
    }

    // Check if the text is not too long
    if (strlen($text) > $maxLength) {
        return "The text is too long";
    }

    // Security layer
    $IFSresult = IFS($text);
    if ($IFSresult != "") {
        return $IFSresult;
    }

    return "";
}

function isFieldEmpty($field)
{
    $field = preg_replace('/\s+/', '', $field);

    if ($field == "") {
        return true;
    }
    return false;
}

?>