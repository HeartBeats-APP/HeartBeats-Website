/* This file contains the header, modify the html code below to modify the header */

document.write(`

<link rel="stylesheet" href="/Header/header.css"/>
<link rel="stylesheet" href="/css/components/componentsV2.css"/>


<div class="header">
    <div class="header-left">

        <div class="header-logo">
            <img class="tab-logo" onclick="window.location.href='/index.html'" src="/Header/svg/Logo.svg"
                alt="HeartBeats Logo" />
        </div>

        <div class="header-tab" onclick="window.location.href='/dashboard.html'">
            <img class="tab-icon" src="/Header/svg/Dashboard.svg" width="50" height="50" alt="" />
            <a>Dashboard</a>
        </div>

        <div class="header-tab" onclick="window.location.href='/q&a.html'">
            <img class="tab-icon" src="/Header/svg/Questions.svg" width="50" height="50" alt="" />
            <a>Q&A</a>
        </div>

        <div class="header-tab" onclick="window.location.href='/contact/contact.html'">
            <img class="tab-icon" src="/Header/svg/Chat.svg" width="50" height="50" alt="" />
            <a>Contact</a>
        </div>


    </div>
    <div class="header-right">
        <button id="account-button" onclick="adaptiveLoginButton()" class="third-button"></button>
        <button class="language-button">En</button>
    </div>
</div>

<script>
    if (localStorage.getItem("connected") == 'false') {
        document.getElementById("account-button").innerHTML = "Login";
    } else {
        document.getElementById("account-button").innerHTML = "Account";
    }
</script>

`);

function adaptiveLoginButton() {
    if (localStorage.getItem("connected") == "true") {
        document.getElementById("account-button").innerHTML = "Account";
        window.location.href = "/account/user.html";

    } else {
        document.getElementById("account-button").innerHTML = "Login";
        window.location.href = "/account/login.html";
    }
}