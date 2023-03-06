var deviceDeleteConfirmation = '0';

function getDeviceInfo() {
    var email = localStorage.getItem('email');
    if (email == null) {
        window.location.href = "/account/login.html";
        return;
    }

    // Get if the user has a device registered
    var request = new XMLHttpRequest();
    request.open("GET", "php/get-device-registered.php?email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == false) {
                // If No, display the setup card instead of the device card and remove the device info from the local storage
                localStorage.setItem('deviceRegistered', "false");
                localStorage.setItem('purshaseDate', "");
                localStorage.setItem('serialNumber', "");
            }
            else {

                // If Yes, get the device info and display it in the device card
                try {
                    var response = JSON.parse(this.responseText);
                    document.getElementById("purshaseDate").innerHTML = response.purshaseDate;
                    document.getElementById("serialNumber").innerHTML = response.serialNumber;
                } catch (e) {
                    // TODO: don't print the error message but store it somewhere
                }

                localStorage.setItem('deviceRegistered', "true");
                localStorage.setItem('purshaseDate', response.purshaseDate);
                localStorage.setItem('serialNumber', response.serialNumber);

            }
        }
    };

    request.send();
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
        if (email == null) {
            window.location.href = "/account/login.html";
            return;
        }
    
        // Delete the device in the database
        var request = new XMLHttpRequest();
        request.open("GET", "php/device-delete.php?email=" + email, true);
        request.send();

        getDeviceInfo();
        updatePageInfo();
    }
}

function addNewDevice() {

    //Get serial number from user
    var serialNumber = prompt("To pair a new device, enter it's serial number", "XXXX-XXXX");
    if (serialNumber == null || serialNumber.length < 8) {
        return;
    }
    localStorage.setItem('serial', serialNumber);

    // If login has failed and we can't retrieve the email, ask it to the user
    var email = localStorage.getItem('email');
    if (email == null) {
        window.location.href = "/account/login.html";
        return;
    }
    localStorage.setItem('email', email);

    // Get the date 
    var date = new Date().toISOString().slice(0, 10);

    //Register the device in the database
    var request = new XMLHttpRequest();
    request.open("GET", "php/device-register.php?serial=" + serialNumber + "&date=" + date + "&email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                getDeviceInfo();
                updatePageInfo();
            }
            else {
                // If the device has not been registered, display the error message and remove the device info from the local storage
                localStorage.setItem('deviceRegistered', "false");
                localStorage.setItem('purshaseDate', "");
                localStorage.setItem('serialNumber', "");

                try {
                    var response = JSON.parse(this.responseText);
                    alert(response.message);
                } catch (e) {
                    // handle the error
                }
            }
        }
    };

    request.send();
}

function logout() {

        //Log out the user
        var request = new XMLHttpRequest();
        request.open("GET", "php/logout.php?email=" + email, true);
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
    
                if (this.responseText == true) {
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
                else {
                    // TODO: handle the error
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




