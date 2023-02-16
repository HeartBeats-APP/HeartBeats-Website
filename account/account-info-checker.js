const forbiddenNames = ["admin", "root", "administrator", "moderator", "mod", "moderateur", "fdp", "connard", "con", "connasse", "pute", "salope", "administrateur", "administratrice", "marie-soline",];
const numberToId = ["name", "email", "password", "passwordConfirm"];

var submitButton = document.getElementById("submit-button");

submitButton.addEventListener("click", function () {
    disableButtonIfIncorrectData();
});



function disableButtonIfIncorrectData() {

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordConfirm = document.getElementById("password-confirm").value;

    var formElements = [name, email, password, passwordConfirm];
    var isDatasCorrect = true;
    clearAllErrors();

    // Check if the password is strong enough
    var result = zxcvbn(password);
    if (result.score < 3) {
        isDatasCorrect = false;
        printError("password", "The password is too weak");
    }

    // Check if the name is not too short;
    if (name.length < 3) {
        isDatasCorrect = false;
        printError("name", "The name is too short");
    }

    // Check if the email is valid
    if (!validateEmail(email)) {
        isDatasCorrect = false;
        printError("email", "The email is not valid");
    }

    // Check if the password and the password confirmation are the same
    if (password !== passwordConfirm) {
        isDatasCorrect = false;
        printError("passwordConfirm", "Passwords doesn't match");
    }

    // Check if the name is not forbidden
    for (var i = 0; i < forbiddenNames.length; i++) {
        name = name.toLowerCase();
        if (name == forbiddenNames[i]) {
            isDatasCorrect = false;
            printError("name", "This name can't be used");
        }
    }

    // Check if the datas are not empty
    for (var i = 0; i < formElements.length; i++) {

        var elementData = formElements[i];
        elementData = elementData.replace(/\s/g, '');

        if (elementData === '') {
            isDatasCorrect = false;
            printError(numberToId[i], "This field can't be empty");
        }
    }




    // Don't let the user submit the form if the datas are incorrect
    if (isDatasCorrect) {
        document.location.href = "account.html";
    }

}

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Print an error message in the HTML
function printError(elemName, message) {
    document.getElementById(elemName + "-warning-message").innerHTML = message;
}

function clearAllErrors() {
    for (var i = 0; i < numberToId.length; i++) {
        printError(numberToId[i], "");
    }
}