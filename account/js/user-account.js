var deviceDeleteConfirmation = '0';

function getDeviceInfo() {
    var email = localStorage.getItem('email');
    if (email == null || email == "") {
        window.location.href = "/account/login.html";
        document.getElementById("email-warning-message").innerHTML = "Something went wrong, please log in again";
        return;
    }

    document.getElementById("purshaseDate").innerHTML = localStorage.getItem('addedDate');
    document.getElementById("serialNumber").innerHTML = localStorage.getItem('deviceID');
}

function updatePageInfo() {
    localStorage.setItem('deviceDeleteConfirmation', "0");

    // Update the page info (and the responsive layout)
    if (localStorage.getItem('deviceRegistered') == "true") {
        if (window.innerWidth < 1200) {
            document.getElementById("device-card").style.display = "grid";
        } else {
            document.getElementById("device-card").style.display = "flex";
        }
        document.getElementById("setup-card").style.display = "none";
    } else {
        document.getElementById("device-card").style.display = "none";
        document.getElementById("setup-card").style.display = "flex";
    }
}

function deleteDevice() {
    deviceDeleteConfirmation = localStorage.getItem('deviceDeleteConfirmation');

    if (deviceDeleteConfirmation == "0") {
        localStorage.setItem('deviceDeleteConfirmation', "1");
        document.getElementById("remove-button").innerHTML = "Click to confirm";

    } else {

        var email = localStorage.getItem('email');
        if (email == null || email == "") {
            window.location.href = "/account/login.html";
            return;
        }

        // Delete the device in the database
        var request = new XMLHttpRequest();
        request.open("GET", "php/device-delete.php?email=" + email, true);
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (this.responseText != true) {
                    try {
                        var response = JSON.parse(this.responseText);
                        window.alert(response.errorMessage);
                    } catch (e) {
                        window.alert("Something went wrong on our side, please try again later");
                    }
                } else {
                    getSession(email);
                    window.location.reload();
                }
            }
        };
        request.send();

    }
}

function addNewDevice() {

    //Get serial number from user
    var serialNumber = window.prompt("To pair a new device, enter it's serial number", "XXXX-XXXX");
    if (serialNumber.length < 8) {
        window.alert("Invalid serial number");
        return;
    }

    var email = localStorage.getItem('email');
    if (email == null) {
        window.location.href = "/account/login.html";
        document.getElementById("email-warning-message").innerHTML = "Something went wrong, please log in again";
        return;
    }

    // Get the date 
    var date = new Date().toISOString().slice(0, 10);

    getSession(email);

    //Register the device in the database
    var request = new XMLHttpRequest();
    request.open("GET", "php/device-register.php?serial=" + serialNumber + "&date=" + date + "&email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                getSession(email);
                window.location.reload();
            }
            else {
                try {
                    var response = JSON.parse(this.responseText);
                    window.alert(response.errorMessage);
                } catch (e) {
                    window.alert("Something went wrong on our side, please try again later");
                }
            }
        }
    };
    request.send();

}

function logout() {

    document.getElementById("logout-button").style.display = "none";
    //Log out the user
    var request = new XMLHttpRequest();
    request.open("GET", "/account/php/logout.php", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText != true) {

            }

            localStorage.setItem('connected', "false");
            window.location.href = "/index.html";

            // Remove user info from the local storage for security reasons
            localStorage.setItem('deviceRegistered', "false");
            localStorage.setItem('purshaseDate', "");
            localStorage.setItem('serialNumber', "");
            localStorage.setItem('deviceDeleteConfirmation', "0");

            if (localStorage.getItem('stayConnected') == "false") {
                localStorage.setItem('email', "");
            }

        }
    };
    request.send();
}

function getSession(email) {
    var request = new XMLHttpRequest();
    request.open("GET", "/account/php/getSession.php?email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // If answer is false, then it's mean that the user is not connected, that the session has expired or that some informations are incorrect
            if (this.responseText == false) {
                localStorage.setItem('connected', "false");
                window.location.href = "/account/login.html";
                document.getElementById("email-warning-message").innerHTML = "Something went wrong, you need to log in again";
                return;
            }

            var response = JSON.parse(this.responseText);
            localStorage.setItem('connected', "true");
            localStorage.setItem('email', response.email);
            localStorage.setItem('name', response.name);
            localStorage.setItem('deviceID', response.deviceID);
            localStorage.setItem('addedDate', response.addedDate);
            localStorage.setItem('deviceConnected', response.deviceConnected);

            if (response.deviceID != null && response.deviceID != "") {
                localStorage.setItem('deviceRegistered', "true");   
            } else {
                localStorage.setItem('deviceRegistered', "false");
            }
        }
    };
    request.send();
}


// Responsive layout
window.addEventListener('resize', () => {
    if (localStorage.getItem('deviceRegistered') == "false") {
        return;
    }
    if (window.matchMedia("(max-width: 1200px)").matches) {
        document.getElementById("device-card").style.display = "grid";
    } else {
        document.getElementById("device-card").style.display = "flex";
    }
});





