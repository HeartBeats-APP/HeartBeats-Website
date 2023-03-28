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

    <div class="wrapper background1">

        <!-- Main -->
        <div class="card-wrapper">

            <div class="adaptive-margin" style="--coef: 15"></div>
            <div class="main-text">
                <div id="account-row" class="card-row">
                    <h1>Admin</h1>
                    <div class=" secondary-button" onclick="logout()">Logout</div>
                </div>
                <p>Danger Zone 💀</p>
            </div>

            <div class="card security">
                <div id="security-details" class="card-column">
                    <div class="card-row">
                        <h3>Website Security</h3>
                        <h4 class="details">Everything looks good 👌</h4>
                    </div>
                    <div>
                        <h3>Recent logs</h3>
                        <div class="card-column logs">

                            <div class="card-row log-card">AAAA</div>
                            <div class="card-row log-card">bbbb</div>
                            <div class="card-row log-card">CCCC</div>
                            <div class="card-row log-card">DDDD</div>
                            <div class="card-row log-card">EEEE</div>

                        </div>
                    </div>
                </div>
                <div id="security-img" class="card-column">
                    <img src="/public/svg/account/shield-good.svg" alt="everything is awesone 🎶" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/header/Questions.svg" draggable="false"></img>
                <h3>Q&A</h3>
                <h5 class="details">Change the content of the Q&A page</h5> <!-- TODO: name -->
                <div class="to-right not-clickable">
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

            <div class="card">
                <img class="card-icon" src="/public/svg/account/account-icon.svg" draggable="false"></img>
                <h3>Name</h3>
                <div class="badge admin">Admin</div>
                <h5 class="details"><?php echo $data['name'] ?></h5>
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/email-address-icon.svg" draggable="false"></img>
                <h3>Email</h3>
                <h5 class="details"><?php echo $data['email'] ?></h5>
                <div class="to-right not-clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

            <div class="card">
                <img class="card-icon" src="/public/svg/account/password-icon.svg" draggable="false"></img>
                <h3>Password</h3>
                <h5 class="details">**********</h5>
                <div onclick="window.location.href='/account/changePassword'" class="to-right clickable">
                    <h4>Change</h4>
                    <img class="card-icon small" src="/public/svg/account/arrow-right-icon.svg" alt="" draggable="false">
                </div>
            </div>

        </div>
    </div>

</body>
<script src="/public/js/account/user-account.js"></script>

</html>