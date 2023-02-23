<?php

$forbiddenCharacters = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "]", "{", "}", ";", ":", "'", ",", ".", "<", ">", "/", "?", "~", "`", "|", "\\", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "É", "È", "Ê", "Ë", "À", "Â", "Ä", "Ù", "Û", "Ü", "Î", "Ï", "Ô", "Ö", "Ç", "œ", "æ", "Œ", "Æ", "€", "£", "¥", "¤", "§", "°", "²", "³", "µ", "¶", "¹", "¼", "½", "¾", "¿", "¡", "«", "»");
$forbiddenNames = array("admin", "root", "administrator", "moderator", "mod", "moderateur", "fdp", "connard", "con", "connasse", "pute", "salope", "administrateur", "administratrice", "marie-soline", "marie soline", "marie solin", "marie-solin", "superadmin", "super-admin", "super admin", "super-administrator", "super administrator", "super-administrateur", "super administrateur", "super-administratrice", "super administratrice", "super-mod", "super mod", "super-moderator", "super moderator", "super-moderateur", "super moderateur", "super-moderatrice", "super moderatrice", "super-modérateur", "super modérateur", "super-modératrice", "super modératrice", "super-modérateur", "super modérateur", "sup", "moderateur", "mod");

function createAccount($name, $email, $password, $passwordConfirmation) {

    $nameIsCorrect = checkName($name);
    $emailIsCorrect = checkEmailAdress($email);
    $passwordIsCorrect = checkPasswordCreation($password);
    $passwordConfirmationIsCorrect = checkPasswordConfirmation($password, $passwordConfirmation);

    if ($nameIsCorrect && $emailIsCorrect && $passwordIsCorrect && $passwordConfirmationIsCorrect) {
        // Save the user in the database and log them in
        header("Location: /dashboard.html");
        exit;
    } else {
        // We can't create the account
        //TODO
    }
}

function recoverPassword() {
    $email = $_POST["email"];

    if (checkEmailAdress($email)) {
        // Send a new password to the user's email and display a message
        echo "<h1>Check your inbox</h1>";
        echo "<p>We've sent you an email with a new password inside</p>";

        // Change button text and link it to the login page
        echo '<button onclick="window.location.href=\'login.html\'">Back to login</button>';
    }
}

function checkName($name) {

    // Check if name is not empty
    if (isFieldEmpty($name)) {
        echo "<p>This field can't be empty</p>";
        return false;
    }

    // Check if name is not too short
    if (strlen($name) < 2) {
        echo "<p>The name is too short</p>";
        return false;
    }

    // Check if name has not forbidden characters
    global $forbiddenCharacters;
    foreach ($forbiddenCharacters as $char) {
        if (strpos($name, $char) !== false) {
            echo "<p>The name can't contain special characters</p>";
            return false;
        }
    }

    // Check if the name is not forbidden
    global $forbiddenNames;
    $name = strtolower($name);
    if (in_array($name, $forbiddenNames)) {
        echo "<p>This name can't be used</p>";
        return false;
    }

    return true;
}

function checkEmailAdress($email) {
   
    // Check if the email is not empty
    if (isFieldEmpty($email)) {
        return "This field can't be empty";
    }

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "This email is not valid";
    }

    //check if email exist in database
    //TODO

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
        echo "This field can't be empty";
        return false;
    }

    //$insight = zxcvbn($password);

    /*if ($insight['score'] < 3) {
        echo "The password is too weak";
        return false;
    } */
}

function checkPasswordConfirmation($password, $passwordConfirmation) {

    // Check if the password confirmation is not empty
    if (isFieldEmpty($passwordConfirmation)) {
        echo "This field can't be empty";
        return false;
    }

    // Check if the password confirmation matches the password
    if ($password !== $passwordConfirmation) {
        echo "Passwords doesn't match";
        return false;
    }

    echo "";
    return true;
}

function isFieldEmpty($field) {
    $field = preg_replace('/\s+/', '', $field);

    if ($field == "") {
        return true;
    }
    return false;
}

?> 