var submitButton = document.getElementById("submit-button-passwordRecovery");

submitButton.addEventListener("click", function () {
    checkForCorrectEmail();
});

function checkForCorrectEmail() {

    var email = document.getElementById("email").value;

    var isDatasCorrect = true;
    clearAllErrors();

    // Check if the email is valid
    if (!validateEmail(email)) {
        isDatasCorrect = false;
        printError("Please enter a valid email address");
    }

    // Check if the email is not empty
    if (email.replace(/\s/g, '') == "") {
        isDatasCorrect = false;
        printError("This field can't be empty");
    }

    // Check if email exist in database
    // TODO

    if (isDatasCorrect) {
        sendEmail();
        updateHTMLpage();
    }
}

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function printError(message) {
    document.getElementById("email-warning-message").innerHTML = message;
}

function clearAllErrors() {
    document.getElementById("email-warning-message").innerHTML = "";
}

function sendEmail() {
    /* Code written by copilot, NOT TESTED YET.

    var email = document.getElementById("email").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("email-warning-message").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "/account/password-recovery", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);
    */
}

function updateHTMLpage() {

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

