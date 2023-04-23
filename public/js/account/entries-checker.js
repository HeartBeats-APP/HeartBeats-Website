function login() {

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (isFieldEmpty(email)) {
        document.getElementById("email-warning-message").innerHTML = "Please enter your email";
        return;
    }
    if (isFieldEmpty(password)) {
        document.getElementById("password-warning-message").innerHTML = "Please enter your password";
        return;
    }

    var request = new XMLHttpRequest();
    request.open("GET", "/account/logUserIn?email=" + email + "&password=" + password, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                window.location.href = "/dashboard";
                // Create a cookie to store the user's data
                localStorage.setItem('email', email);
            }
            else {
                localStorage.setItem('email', "");
                try {
                    var response = JSON.parse(this.responseText);
                    document.getElementById("email-warning-message").innerHTML = response.emailErrorMessage;
                    document.getElementById("password-warning-message").innerHTML = response.passwordErrorMessage;
                } catch (e) {
                    window.alert(this.responseText);
                }
            }
        }
    };

    request.send();
}

function createAccount() { /* AKA register */
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordConfirmation = document.getElementById("password-confirmation").value;
    var zxcvbnSS = zxcvbn(password);

    if (isFieldEmpty(name)) {
        document.getElementById("name-warning-message").innerHTML = "Please enter your name";
        return;
    }
    if (isFieldEmpty(email)) {
        document.getElementById("email-warning-message").innerHTML = "Please enter your email";
        return;
    }
    if (isFieldEmpty(password)) {
        document.getElementById("password-warning-message").innerHTML = "Please enter your password";
        return;
    }
    if (isFieldEmpty(passwordConfirmation)) {
        document.getElementById("passwordConfirm-warning-message").innerHTML = "Please confirm your password";
        return;
    }
    if (password != passwordConfirmation) {
        document.getElementById("passwordConfirm-warning-message").innerHTML = "Passwords doesn't match";
        return;
    }
    if (zxcvbnSS.score < 3) {
        document.getElementById("password-warning-message").innerHTML = "Your password is too weak";
        return;
    }

    //Send HTTPS request to server
    var request = new XMLHttpRequest();
    request.open("GET", "/account/registerUser?name=" + name + "&email=" + email + "&password=" + password + "&passwordConfirmation=" + passwordConfirmation + "&zxcvbnSS=" + zxcvbnSS.score, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            /* Update the page */
            if (this.responseText == true) {
                localStorage.setItem('email', email);
                document.getElementById("title").innerHTML = "Check your inbox";
                document.getElementById("subtitle").innerHTML = "An email will be sent to confirm your account";
                document.getElementById("register-form").remove();
                document.getElementById("create-account-button").remove();
                document.getElementById("login-button").innerHTML = "Login";
                document.getElementById("section-img").style.display = "none";
                document.getElementById("email-animation").style.display = "flex";
            }
            else {
                try {
                    // Handle the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("name-warning-message").innerHTML = response.nameErrorMessage;
                    document.getElementById("email-warning-message").innerHTML = response.emailErrorMessage;
                    document.getElementById("password-warning-message").innerHTML = response.passwordErrorMessage;
                    document.getElementById("passwordConfirm-warning-message").innerHTML = response.passwordConfirmErrorMessage;
                } catch (e) {
                    window.alert("Something went wrong, please try again later");
                }
            }
        }
    };

    request.send();

}

function recoverPassword() {
    var email = document.getElementById("email").value;

    if (isFieldEmpty(email)) {
        document.getElementById("email-warning-message").innerHTML = "Please enter your email";
        return;
    }

    var request = new XMLHttpRequest();
    request.open("GET", "/account/getNewPassword?email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {

                // Update login text
                document.getElementById("title").innerHTML = "Check your inbox";
                document.getElementById("subtitle").innerHTML = "If your account exist, we'll send you an email with a new password inside";
                document.getElementById("login-field").remove();
                document.getElementById("email-animation").style.display = "block";

                // Change button text
                document.getElementById("submit-button-passwordRecovery").innerHTML = "Back to login";
                document.getElementById("submit-button-passwordRecovery").addEventListener("click", function () {
                    window.location.href = "login.html";
                });
            }
            else {
                window.alert(this.responseText);
            }
        }
    };

    request.send();

}

function showPassword() {
    var x = document.getElementById("password");
    var confirmation = document.getElementById("password-confirmation");

    if (x.type === "password") {
        x.type = "text";
        if (confirmation != null) {
            confirmation.type = "text";
        }

    } else {
        x.type = "password";
        if (confirmation != null) {
            confirmation.type = "password";
        }
    }
}

function isFieldEmpty(field) {
    field = field.replace(/\s/g, '');

    if (field == "") {
        return true;
    }
    return false;
}
