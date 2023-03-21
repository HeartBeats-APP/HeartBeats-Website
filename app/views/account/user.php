<!DOCTYPE html>
<html>

<head>
    <title>HeartBeats</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/css/components/componentsV2.css" />
    <link rel="stylesheet" href="css/account.css" />
    <link rel="stylesheet" href="css/user.css" />
    <link rel="stylesheet" href="css/badges.css" />

</head>

<body>

    <div class="wrapper background1">

        <!-- Header -->
        <script src="/header/header.js"></script>

        <!-- Main -->
        <div class="card-wrapper">

            <div class="adaptive-margin" style="--coef: 15"></div>
            <div class="main-text">
                <div id="account-row" class="card-row">
                    <h1>Account</h1>
                    <div id="logout-button" class="to-right secondary-button" onclick="logout()">Logout</div>
                </div>
                <p>Here you can change your account settings.</p>
            </div>

            <div id="setup-card" class="card new-device" onclick="addNewDevice()">
                <img class="card-icon" src="svg/pairing-icon.svg"></img>
                <h3>Device Setup</h3>
                <h5 class="details">Click to pair a new device and add it to your account</h5>
            </div>

            <div class="card">
                <img class="card-icon" src="svg/account-icon.svg"></img>
                <h3>Name</h3>
                <div class="badge admin">Admin</div>
                <h5 class="details">Matthew</h5> <!-- TODO: name -->
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="svg/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="svg/email-address-icon.svg"></img>
                <h3>Email</h3>
                <h5 class="details">matthieu.admin@heart-beats.fr</h5> <!-- TODO: email -->
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="svg/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="svg/password-icon.svg"></img>
                <h3>Password</h3>
                <h5 class="details">**********</h5>
                <div onclick="window.location.href='password-recovery.html'" class="to-right clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="svg/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div id="device-card" class="card">

                <img class="card-image" src="png/Pulse1.png"></img>

                <div id="device-infos" class="card-column">
                    <div class="card-row">
                        <h3>Your device:</h3>
                        <h4 class="no-wrap">HeartBeats Pulse 1</h4>
                    </div>
                    <div class="card-row">
                        <h3>Serial number:</h3>
                        <h4 id="serialNumber" class="no-wrap">61308-WPA3X</h4>
                    </div>
                    <div class="card-row">
                        <h3>Purchase date:</h3>
                        <h4 id="purshaseDate" class="no-wrap">Jan 01 2023</h4>
                    </div>
                    <div id="buttons-row" class="card-row">
                        <button onclick="deleteDevice()" id="remove-button" class="main-button">Remove</button>
                        <button class="secondary-button">Copy Infos</button>
                    </div>
                </div>

                <div id="device-controls" class="card-column">
                    <h3>Device Controls</h3>

                    <div class="card-row">
                        <h4>Satuts:</h4> <!-- TODO: Username -->
                        <h5>Connected 🟢</h5>
                    </div>

                    <div class="card-row">
                        <div class="measure-row">
                            <h4>CO2:</h4> <!-- TODO: Username -->
                            <h5>Low</h5>
                        </div>

                        <div class="measure-row">
                            <h4>BPM:</h4> <!-- TODO: Username -->
                            <h5>85 </h5>
                        </div>
                    </div>

                    <div class="card-row">
                        <div class="measure-row">
                            <h4>Temperature:</h4> <!-- TODO: Username -->
                            <h5>20°C</h5>
                        </div>

                        <div class="measure-row">
                            <h4>Humidity:</h4> <!-- TODO: Username -->
                            <h5>30%</h5>
                        </div>
                    </div>

                    <div class="toggle-container">
                        <input type="radio" id="radio1" name="toggle" value="1" style="--selected: 1">
                        <label for="radio1">Battery Saver</label>
                        <input type="radio" id="radio2" name="toggle" value="2" style="--selected: 2" checked>
                        <label for="radio2">Normal</label>
                        <input type="radio" id="radio3" name="toggle" value="3" style="--selected: 3">
                        <label for="radio3">Debug</label>
                        <span class="toggle-state"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
    <script src="js/user-account.js"></script>
    <script>
        if (localStorage.getItem("connected") != 'true') {
            window.location.href = "/account/login.htmllogin.html";
        }
        getDeviceInfo();
        updatePageInfo();
    </script>

</html>