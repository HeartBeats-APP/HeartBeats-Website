const forbiddenCharacters = ["!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "]", "{", "}", ";", ":", "'", ",", ".", "<", ">", "/", "?", "~", "`", "|", "\\", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
const forbiddenNames = ["admin", "root", "administrator", "moderator", "mod", "moderateur", "fdp", "connard", "con", "connasse", "pute", "salope", "administrateur", "administratrice", "marie-soline",];


function login() {

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (checkEmailAdress(email) && checkPassword(email, password)) {
        // Then we can log the user in
        document.location.href = "/dashboard.html";
    } else {
        // We can't log the user in
        //TODO
    }

}


function createAccount() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordConfirmation = document.getElementById("password-confirmation").value;

    var nameIsCorrect = checkName(name);
    var emailIsCorrect = checkEmailAdress(email);
    var passwordIsCorrect = checkPasswordCreation(password);
    var passwordConfirmationIsCorrect = checkPasswordConfirmation(password, passwordConfirmation);

    if (nameIsCorrect && emailIsCorrect && passwordIsCorrect && passwordConfirmationIsCorrect) {
        // Then we can create the account
        document.location.href = "/dashboard.html";
    } else {
        // We can't create the account
        //TODO
    }
}

function recoverPassword() {
    var email = document.getElementById("email").value;

    if (checkEmailAdress(email)) {
        
        // update login text
        document.getElementById("title").innerHTML = "Check your inbox";
        document.getElementById("subtitle").innerHTML = "We've sent you an email with a new password inside";

        document.getElementById("login-field").remove();
        document.getElementById("email-animation").style.display = "block";


        // change button text
        document.getElementById("submit-button-passwordRecovery").innerHTML = "Back to login";
        document.getElementById("submit-button-passwordRecovery").addEventListener("click", function () {
            window.location.href = "login.html";
        }
        );
    }

}



function checkName(name) {

    //Check if name is not empty
    if (isFieldEmpty(name)) {
        document.getElementById("name-warning-message").innerHTML = "This field can't be empty";
        return false;
    }

    //Check if name is not too short
    if (name.length < 2) {
        document.getElementById("name-warning-message").innerHTML = "The name is too short";
        return false;
    }

    //Check if name has not forbidden characters
    for (var i = 0; i < forbiddenCharacters.length; i++) {
        if (name.includes(forbiddenCharacters[i])) {
            document.getElementById("name-warning-message").innerHTML = "The name can't contain special characters";
            return false;
        }
    }

    // Check if the name is not forbidden
    for (var i = 0; i < forbiddenNames.length; i++) {
        name = name.toLowerCase();

        if (name == forbiddenNames[i]) {
            document.getElementById("name-warning-message").innerHTML = "This name is can't be used";
        }
        return false;
    }

    document.getElementById("name-warning-message").innerHTML = "";
    return true;
}

function checkEmailAdress(email) {
    var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // Check if the email is not empty
    if (isFieldEmpty(email)) {
        document.getElementById("email-warning-message").innerHTML = "This field can't be empty";
        return false;
    }

    if (!emailReg.test(String(email).toLowerCase())) {
        document.getElementById("email-warning-message").innerHTML = "Please enter a valid email address";
        return false;
    }

    //check if email exist in database
    //TODO

    document.getElementById("email-warning-message").innerHTML = "";
    return true;
}

function checkPassword(email, password) {

    // Check if the password is not empty
    if (isFieldEmpty(password)) {
        document.getElementById("password-warning-message").innerHTML = "This field can't be empty";
        return false;
    }

    //check if password match with the one in database
    //TODO

    document.getElementById("password-warning-message").innerHTML = "";
    return true;
}

function checkPasswordCreation(password) {

    // Check if the password is not empty
    if (isFieldEmpty(password)) {
        document.getElementById("password-warning-message").innerHTML = "This field can't be empty";
        return false;
    }

    var insight = zxcvbn(password);

    if (insight.score < 3) {
        document.getElementById("password-warning-message").innerHTML = "The password is too weak";
        return false;
    }
}

function checkPasswordConfirmation(password, passwordConfirmation) {

    // Check if the password confirmation is not empty
    if (isFieldEmpty(passwordConfirmation)) {
        document.getElementById("passwordConfirm-warning-message").innerHTML = "This field can't be empty";
        return false;
    }

    // Check if the password confirmation match with the password
    if (password != passwordConfirmation) {
        document.getElementById("passwordConfirm-warning-message").innerHTML = "Passwords doesn't match";
        return false;
    }
}

function isFieldEmpty(field) {
    field = field.replace(/\s/g, '');

    if (field == "") {
        return true;
    }
    return false;
}
