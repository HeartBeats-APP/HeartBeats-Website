function login() {

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var stayConnected = document.getElementById("switch").checked;

    var request = new XMLHttpRequest();
    request.open("GET", "php/login.php?email=" + email + "&password=" + password + "&stayConnected=" + stayConnected, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                window.location.href = "/dashboard.html";
                localStorage.setItem('email', email);
                localStorage.setItem('connected', "true");
            }
            else {
                try {
                    // Parse the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("email-warning-message").innerHTML = response.emailErrorMessage;
                    document.getElementById("password-warning-message").innerHTML = response.passwordErrorMessage;
                } catch (e) {
                    document.getElementById("email-warning-message").innerHTML = this.responseText;
                }
            }
        }
    };

    request.send();
}

function createAccount() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordConfirmation = document.getElementById("password-confirmation").value;
    var zxcvbnSS = zxcvbn(password);

    //Send HTTPS request to server
    var request = new XMLHttpRequest();
    request.open("GET", "php/register.php?name=" + name + "&email=" + email + "&password=" + password + "&passwordConfirmation=" + passwordConfirmation +"&zxcvbnSS=" + zxcvbnSS.score, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                document.getElementById("title").innerHTML = "You're almost there!";
                document.getElementById("subtitle").innerHTML = "We've sent you an email to confirm your account. <br> Please check your inbox and click the link to complete the registration process.";
                document.getElementById("register-form").remove();
                document.getElementById("buttons-area").remove();
                document.getElementById("email-animation").style.display = "block";

                
            }
            else {
                try {
                    // Parse the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("name-warning-message").innerHTML = response.nameErrorMessage;
                    document.getElementById("email-warning-message").innerHTML = response.emailErrorMessage;
                    document.getElementById("password-warning-message").innerHTML = response.passwordErrorMessage;
                    document.getElementById("passwordConfirm-warning-message").innerHTML = response.passwordConfirmErrorMessage;
                } catch (e) {
                    document.getElementById("name-warning-message").innerHTML = this.responseText;
                }
            }
        }
    };

    request.send();

}

function recoverPassword() {
    var email = document.getElementById("email").value;

    var request = new XMLHttpRequest();
    request.open("GET", "php/recover-password.php?email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {

                // update login text
                document.getElementById("title").innerHTML = "Check your inbox";
                document.getElementById("subtitle").innerHTML = "If your account exist, we'll send you an email with a new password inside";

                document.getElementById("login-field").remove();
                document.getElementById("email-animation").style.display = "block";


                // change button text
                document.getElementById("submit-button-passwordRecovery").innerHTML = "Back to login";
                document.getElementById("submit-button-passwordRecovery").addEventListener("click", function () {
                    window.location.href = "login.html";
                }
                );
            }
            else {
                try {
                    // Parse the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("email-warning-message").innerHTML = response.emailErrorMessage;
                } catch (e) {
                    document.getElementById("email-warning-message").innerHTML = this.responseText;
                }
            }
        }
    };

    request.send();

}