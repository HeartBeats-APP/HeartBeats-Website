function deleteDevice() {

    var confirmation = window.confirm("Are you sure you want to delete this device from your account?");
    if (!confirmation) {
        return;
    }

    var request = new XMLHttpRequest();
    request.open("GET", "/account/deleteDevice", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText != true) {
                try {
                    var response = JSON.parse(this.responseText);
                    window.alert(response.errorMessage);
                } catch (e) {
                    window.alert(this.responseText);
                }
            } else {
                window.location.reload();
            }
        }
    };
    request.send();

}

function addNewDevice() {

    //Get serial number from user
    var serialNumber = window.prompt("To pair a new device, enter it's serial number", "XXXX-XXXX");

    if (serialNumber.length < 8) {
        window.alert("Invalid serial number");
        return;
    }

    // Get the date 
    var date = new Date().toISOString().slice(0, 10);

    //Register the device in the database
    var request = new XMLHttpRequest();
    request.open("GET", "/account/registerDevice?serial=" + serialNumber + "&date=" + date, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == true) {
                window.location.reload();
            }
            else {
                window.alert(this.responseText);
            }
        }
    };
    request.send();

}

function logout() {

    //Log out the user
    var request = new XMLHttpRequest();
    request.open("GET", "/account/logUserOut", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText != true) {
                window.alert(this.responseText);
            }

            window.location.href = "/account/login";
        }
    };
    request.send();
}

function debugMode() {
    var value = document.getElementById("switch").checked;

    if (value == true){
        value = "1";
    } else {
        value = "0";
    }

    var request = new XMLHttpRequest();
    request.open("GET", "/account/debugMode?value=" + value, true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText != true) {
                document.getElementById("switch").checked = false;
                window.alert(this.responseText);
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






