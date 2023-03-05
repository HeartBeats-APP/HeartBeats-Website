var deviceDeleteConfirmation = '0';


function updatePageInfo() {
    localStorage.setItem('deviceDeleteConfirmation', "0");

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
        localStorage.setItem('deviceRegistered', "false");
        localStorage.setItem('serial', "");
        updatePageInfo();
    }
}

function addNewDevice() {

    //Get serial number from user
    var serialNumber = prompt("To pair a new device, enter it's serial number", "XXXX-XXXX");
    while (serialNumber == null || serialNumber.length < 8) {
        serialNumber = prompt("ℹ️ Incorrect serial number \n Please try-again ", "XXXX-XXXX");
    }
    localStorage.setItem('serial', serialNumber);

    // If login has failed and we can't retrieve the email, ask it to the user
    var email = localStorage.getItem('email');
    while (email == null) {
        email = prompt("We got lost :/ \n Please re-enter your mail", "");
    }
    localStorage.setItem('email', email);

    // Get the date 
    var date = new Date().toISOString().slice(0, 10);

    //Send HTTPS request to register the device
    var request = new XMLHttpRequest();
    request.open("GET", "php/device-register.php?serial=" + serialNumber + "&date=" + date + "&email=" + email, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                localStorage.setItem('deviceRegistered', "true");
                updatePageInfo();
            }
            else {
                localStorage.setItem('serial', "");
                localStorage.setItem('deviceRegistered', "false");
            }
        }
    };

    request.send();
}

function logout() {
    localStorage.setItem('email', "");
    localStorage.setItem('connected', "false");
    window.location.href = "/index.html";
}

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




