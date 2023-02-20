/* This file contains the header, modify the html code below to modify the header */

document.write(`

<link rel="stylesheet" href="/Header/header.css"/>
<link rel="stylesheet" href="Header/header.css"/>
<link rel="stylesheet" href="/css/components/components.css"/>


<div class="header">
    <div class="header-left">

        <div class="header-logo">
            <img class="tab-logo" onclick="window.location.href='/index.html'" src="/images/Logo.svg"
                alt="HeartBeats Logo" />
        </div>

        <div class="header-tab" onclick="window.location.href='/dashboard.html'">
            <img class="tab-icon" src="/Header//svg/Dashboard.svg" width="50" height="50" alt="" />
            <a>Dashboard</a>
        </div>

        <div class="header-tab" onclick="window.location.href='/q&a.html'">
            <img class="tab-icon" src="/Header/svg/Questions.svg" width="50" height="50" alt="" />
            <a>Q&A</a>
        </div>

        <div class="header-tab" onclick="window.location.href='/contact.html'">
            <img class="tab-icon" src="/Header/svg/Chat.svg" width="50" height="50" alt="" />
            <a>Contact</a>
        </div>


    </div>
    <div class="header-right">
        <button onclick="window.location.href='/account/login.html'" class="second-button orange">Account</button>
        <button class="language-button">En</button>
    </div>
</div>


`);