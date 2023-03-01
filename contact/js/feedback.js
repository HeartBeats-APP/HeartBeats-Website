function sendFeedback() {

    var title = document.getElementById("title").value;
    var message = document.getElementById("message").value;

    var request = new XMLHttpRequest();
    request.open("GET", "php/feedback.php?title=" + title + "&message=" + message, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                document.getElementById("title").innerHTML = "Thank you for your feedback!";
                document.getElementById("subtitle").innerHTML = "We appreciate your time and effort";
                document.getElementById("input-fields").remove();
                document.getElementById("animation").style.display = "block";
            }
            else {
                try {
                    // Parse the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("title-error-message").innerHTML = response.titleError;
                    document.getElementById("text-error-message").innerHTML = response.messageError;
                } catch (e) {
                    document.getElementById("text-error-message").innerHTML = this.responseText;
                }
            }
        }
    };

    request.send();
}