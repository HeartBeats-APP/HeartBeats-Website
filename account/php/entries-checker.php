<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/protected-computing/private-compute-core.php');

function checkName($name)
{

    // Check if name is not empty
    if (isFieldEmpty($name)) {
        return "This field can't be empty";
    }

    // Check if name is not too short
    if (strlen($name) < 3) {
        return "The name is too short";
    }

    // Check if name contains only letters, whitespaces, dashes and apostrophes
    if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ\s'-]+$/", $name)) {
        return "The name can only contain letters, dashes, and apostrophes";
    }

    // Security layers
    $IFSresult = IFS($name);
    if ($IFSresult != "") {
        return $IFSresult;
    }
    $INFresult = INF($name);
    if ($INFresult != "") {
        return $INFresult;
    }

    return "";
}

function checkEmailAdress($email)
{

    // Check if the email is not empty
    if (isFieldEmpty($email)) {
        return "This field can't be empty";
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "This email is not valid";
    }

    // Security layer
    $IFSresult = IFS($email);
    if ($IFSresult != "") {
        return $IFSresult;
    }

    return "";
}

function checkPasswordLogin($password)
{

    // Check if the password is not empty
    if (isFieldEmpty($password)) {
        return "This field can't be empty";
    }

    // Security layer
    $IFSresult = IFS($password);
    if ($IFSresult != "") {
        return $IFSresult;
    }

    return "";
}

function checkPasswordCreation($password, $passwordScore)
{

    // Check if the password is not empty
    if (isFieldEmpty($password)) {
        return "This field can't be empty";
    }

    // Check if the password score is not too low
    if ($passwordScore < 3) {
        return "The password is too weak";
    }

    // Security layer
    $IFSresult = IFS($password);
    if ($IFSresult != "") {
        return $IFSresult;
    }

    return "";
}

function checkPasswordConfirmation($password, $passwordConfirmation)
{

    // Check if the password confirmation is not empty
    if (isFieldEmpty($passwordConfirmation)) {
        return "This field can't be empty";
    }

    // Check if the password confirmation matches the password
    if ($password !== $passwordConfirmation) {
        return "Passwords doesn't match";
    }

    // Security layer
    $IFSresult = IFS($passwordConfirmation);
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
