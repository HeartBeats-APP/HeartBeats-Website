<!-- Warning! Modifying the header here will NOT change the header appearance on the website. Please modify the header.js file along with this one -->

<link rel="stylesheet" href="/public/css/components.css" />
<link rel="stylesheet" href="/public/css/header.css" />

<div class="header-wrapper">
    <div class="header">
        <div class="header-left">

            <div class="header-logo">
                <img class="tab-logo" onclick="window.location.href='/index.html'" src="/public/svg/header/Logo.svg" alt="HeartBeats Logo" />
            </div>

            <div class="header-tab" onclick="window.location.href='/dashboard.html'">
                <img class="tab-icon" src="/public/svg/header/Dashboard.svg" width="50" height="50" alt="" />
                <a>Dashboard</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/q&a.html'">
                <img class="tab-icon" src="/public/svg/header/Questions.svg" width="50" height="50" alt="" />
                <a>Q&A</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/contact/contact.html'">
                <img class="tab-icon" src="/public/svg/header/Chat.svg" width="50" height="50" alt="" />
                <a>Contact</a>
            </div>


        </div>
        <div class="header-right">
            <button id="account-button" onclick="adaptiveLoginButton()" class="third-button"></button>
            <button class="language-button">En</button>
        </div>
    </div>
</div>

<script>
    if (localStorage.getItem("connected") == 'false') {
        document.getElementById("account-button").innerHTML = "Login";
    } else {
        document.getElementById("account-button").innerHTML = "Account";
    }
</script>