<?php

$forbiddenCharacters = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "]", "{", "}", ";", ":", "'", ",", ".", "<", ">", "/", "?", "~", "`", "|", "\\", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "É", "È", "Ê", "Ë", "À", "Â", "Ä", "Ù", "Û", "Ü", "Î", "Ï", "Ô", "Ö", "Ç", "œ", "æ", "Œ", "Æ", "€", "£", "¥", "¤", "§", "°", "²", "³", "µ", "¶", "¹", "¼", "½", "¾", "¿", "¡", "«", "»");
$forbiddenNames = array("admin", "root", "administrator", "moderator", "mod", "moderateur", "fdp", "connard", "con", "connasse", "pute", "salope", "administrateur", "administratrice", "marie-soline", "marie soline", "marie solin", "marie-solin", "superadmin", "super-admin", "super admin", "super-administrator", "super administrator", "super-administrateur", "super administrateur", "super-administratrice", "super administratrice", "super-mod", "super mod", "super-moderator", "super moderator", "super-moderateur", "super moderateur", "super-moderatrice", "super moderatrice", "super-modérateur", "super modérateur", "super-modératrice", "super modératrice", "super-modérateur", "super modérateur", "sup", "moderateur", "mod");

function checkName($name) {

    // Check if name is not empty
    if (isFieldEmpty($name)) {
        return "This field can't be empty";
    }

    // Check if name is not too short
    if (strlen($name) < 3) {
        return "The name is too short";
    }

    // Check if name has not forbidden characters
    global $forbiddenCharacters;
    foreach ($forbiddenCharacters as $char) {
        if (strpos($name, $char) !== false) {
            return "The name can't contain special characters";
        }
    }

    // Check if the name is not forbidden
    global $forbiddenNames;
    $name = strtolower($name);
    if (in_array($name, $forbiddenNames)) {
        return "This name can't be used";
    }

    return "";
}

function checkEmailAdress($email, $emailNeedtoExist) {
   
    // Check if the email is not empty
    if (isFieldEmpty($email)) {
        return "This field can't be empty";
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "This email is not valid";
    }

    if ($emailNeedtoExist) {

        //check if email exist in database
        //TODO
    }

    return "";
}

function checkPassword($email, $password) {

    // Check if the password is not empty
    if (isFieldEmpty($password)) {
        return "This field can't be empty";
    }

    //check if password match with the one in database
    //TODO

    return "";
}

function checkPasswordCreation($password) {

    // Check if the password is not empty
    if (isFieldEmpty($password)) {
        return "This field can't be empty";
    }

    return "";

}

function checkPasswordConfirmation($password, $passwordConfirmation) {

    // Check if the password confirmation is not empty
    if (isFieldEmpty($passwordConfirmation)) {
        return "This field can't be empty";
    }

    // Check if the password confirmation matches the password
    if ($password !== $passwordConfirmation) {
        return "Passwords doesn't match";
    }

    return "";
}

function isFieldEmpty($field) {
    $field = preg_replace('/\s+/', '', $field);

    if ($field == "") {
        return true;
    }
    return false;
}

?> 