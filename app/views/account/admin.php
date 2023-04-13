<!DOCTYPE html>
<html>

<head>
    <title>HeartBeats</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/public/css/components.css" />
    <link rel="stylesheet" href="/public/css/account/account.css" />
    <link rel="stylesheet" href="/public/css/account/admin.css" />
    <link rel="stylesheet" href="/public/css/account/badges.css" />

</head>

<body>

    <div class="wrapper background1" id="wrapper">

        <!-- Main -->
        <div class="card-wrapper">

            <div class="adaptive-margin" style="--coef: 10"></div>
            <div class="main-text">
                <div id="account-row" class="row">
                    <h1>Admin</h1>
                    <div class=" secondary-button" onclick="logout()">Logout</div>
                </div>
                <h5>Danger Zone 💀</h5>
            </div>

            <div class="card security">
                <div id="security-details" class="card-column">

                    <div id="overlay-bg"></div>

                    <h2>Website Security</h2>
                    <div class="expandable-card">
                        <h3>Recent logs: </h3>
                        <h5 class="details">Everything is looking good</h5>
                    </div>
                    <div class="expandable-card">
                        <h3>Security check: </h3>
                        <h5 class="details">Everything is looking good</h5>
                    </div>
                    <div class="expandable-card" id="updatesCard" onclick="window.location.href='/account/admin/updates'">
                        <h3>Updates: </h3>
                        <h5 class="details" id="database-text"></h5>
                        <div class="to-right">
                            <div id="updatesIndicator" class="indicator"></div>
                        </div>

                    </div>
                </div>
                <div id="security-img" class="card-column">
                    <img src="/public/svg/account/shield-good.svg" alt="everything is awesone 🎶" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/debug-icon.svg" draggable="false"></img>
                <h3>Debug Mode</h3>
                <h5 id="debugText" class="details">Shows precise error messages for easier problem-solving</h5>
                <div class="to-right" id="DebugModeSwitch">
                    <input onclick="debugMode()" type="checkbox" id="switch" /><label for="switch"></label>
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/account-icon.svg" draggable="false"></img>
                <h3>User View</h3>
                <h5 class="details"> View and manage your account as a normal user</h5>
                <div class="to-right clickable" onclick="window.location.href='/account/user'">
                    <h4>Switch</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/header/Questions.svg" draggable="false"></img>
                <h3>Q&A</h3>
                <h5 class="details">Change the content of the Q&A page</h5>
                <div class="to-right clickable" onclick="window.location.href='/account/admin/faq'">
                    <h4>Modify</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/header/Chat.svg" draggable="false"></img>
                <h3>Live Chat</h3>
                <h5 class="details">Answer to users concerns</h5>
                <div class="to-right not-clickable">
                    <h4>Manage</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

        </div>
    </div>

</body>
<script src="/public/js/account/user-account.js"></script>
<script src="/public/js/account/admin.js"></script>
<script>
    var data = <?php echo json_encode($data); ?>;

    if (data['debugMode'] == "1") {
        document.getElementById("switch").checked = true;
    } else {
        document.getElementById("switch").checked = false;
    }

    var updates = data['updates'];
    document.getElementById("database-text").innerHTML = updates;

    if (updates == "Everything is up to date") {
        document.getElementById("updatesIndicator").classList.add("blue-bg");
    } else {
        document.getElementById("updatesIndicator").classList.add("red-bg");
    }
</script>

</html>