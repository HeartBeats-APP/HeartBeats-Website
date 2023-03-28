function sendFeedback() {

    // Get the values from the input fields
    var title = document.getElementById("message-title").value;
    var message = document.getElementById("message-text").value;

    var request = new XMLHttpRequest();
    request.open("GET", "/contact/getFeedback?title=" + title + "&message=" + message, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                document.getElementById("title").innerHTML = "Thank you for your feedback!";
                document.getElementById("subtitle").innerHTML = "We appreciate your time and effort";
                document.getElementById("input-fields").remove();
                document.getElementById("animation").style.display = "flex";
            }
            else {
                try {
                    // Parse the JSON response
                    var response = JSON.parse(this.responseText);
                    document.getElementById("title-error-message").innerHTML = response.titleErrorMessage;
                    document.getElementById("text-error-message").innerHTML = response.messageErrorMessage;

                    if (response.Error != "" && response.Error != null) {
                        alert(response.Error);
                    }
                } catch (e) {
                    alert("An error occurred while sending your feedback. Please try again later.");
                }
            }
        }
    };

    request.send();
}