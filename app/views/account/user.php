<!DOCTYPE html>
<html>

<head>
    <title>HeartBeats</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/public/css/components.css" />
    <link rel="stylesheet" href="/public/css/account/account.css" />
    <link rel="stylesheet" href="/public/css/account/user.css" />
    <link rel="stylesheet" href="/public/css/account/badges.css" />

</head>

<body>

    <div class="wrapper background1">

        <!-- Main -->
        <div class="card-wrapper">

            <div class="adaptive-margin" style="--coef: 10"></div>
            <div class="main-text">
                <div id="account-row" class="card-row">
                    <h1>Account</h1>
                    <div id="logout-button" class="secondary-button" onclick="logout()">Logout</div>
                </div>
                <h5>Manage your informations and device</h5>
            </div>

            <div id="setup-card" class="card new-device" onclick="addNewDevice()">
                <img class="card-icon" src="/public/svg/account/pairing-icon.svg"></img>
                <h3>Device Setup</h3>
                <h5 class="details">Click to pair a new device and add it to your account</h5>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/account-icon.svg"></img>
                <h3>Name</h3>
                <div id="badge" class="badge">Admin</div>
                <h5 class="details"> <?php echo $data['name'] ?></h5>
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/email-address-icon.svg"></img>
                <h3>Email</h3>
                <h5 class="details"><?php echo $data['email'] ?></h5> <!-- TODO: email -->
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/password-icon.svg"></img>
                <h3>Password</h3>
                <h5 class="details">**********</h5>
                <div onclick="window.location.href='/account/changePassword'" class="to-right clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="">
                </div>
            </div>

            <div id="device-card" class="card">

                <img class="card-image" src="/public/png/Pulse1.png"></img>

                <div id="device-infos" class="card-column">
                    <div class="card-row">
                        <h3>Your device:</h3>
                        <h4 class="no-wrap">HeartBeats Pulse 1</h4>
                    </div>
                    <div class="card-row">
                        <h3>Serial number:</h3>
                        <h4 id="serialNumber" class="no-wrap"><?php echo $data['device id'] ?></h4>
                    </div>
                    <div class="card-row">
                        <h3>Purchase date:</h3>
                        <h4 id="purshaseDate" class="no-wrap"><?php echo $data['added date'] ?></h4>
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
                        <h5 id="device-status"></h5>
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
<script src="/public/js/account/user-account.js"></script>
<script>
    var data = <?php echo json_encode($data); ?>;

    if (data['hasDevice'] == true) {
        if (window.innerWidth < 1200) {
            document.getElementById("device-card").style.display = "grid";
        } else {
            document.getElementById("device-card").style.display = "flex";
        }
        document.getElementById("setup-card").style.display = "none";


        if (data['device connected'] == '1' ) {
            document.getElementById("device-status").innerHTML = 'Connected 🟢';
        } else {
            document.getElementById("device-status").innerHTML = 'Disconnected 🔴';
        }

        document.getElementById("purshaseDate").innerHTML = data['added date'];
    } else {
        document.getElementById("device-card").style.display = "none";
        document.getElementById("setup-card").style.display = "flex";
    }

    var role = data['role'];
    if (role == 'ISEP') {
        document.getElementById("badge").innerHTML = 'ISEP';
        document.getElementById("badge").classList.add('isep');
    } else if (role == 'insider') {
        document.getElementById("badge").innerHTML = 'Insider';
        document.getElementById("badge").classList.add('insider');
    } else if (role == 'admin') {
        document.getElementById("badge").innerHTML = 'Admin';
        document.getElementById("badge").classList.add('admin');
    } else  {
        document.getElementById("badge").innerHTML = 'User';
        document.getElementById("badge").classList.add('user');
    }
</script>

</html>