function login() {

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var request = new XMLHttpRequest();
    request.open("GET", "php/login.php?email=" + email + "&password=" + password, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {    
                window.location.href = "/dashboard.html";
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

}

function recoverPassword() {
    var email = document.getElementById("email").value;

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