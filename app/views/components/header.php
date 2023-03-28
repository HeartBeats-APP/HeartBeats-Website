<!-- Warning! Modifying the header here will NOT change the header appearance on the website. Please modify the header.js file along with this one -->

<link rel="stylesheet" href="/public/css/components.css" />
<link rel="stylesheet" href="/public/css/header.css" />

<div class="header-wrapper">
    <div class="header">
        <div class="header-left">

            <div class="header-logo">
                <img class="tab-logo" onclick="window.location.href='/home'" src="/public/svg/header/Logo.svg" alt="HeartBeats Logo" />
            </div>

            <div class="header-tab" onclick="window.location.href='/dashboard'">
                <img class="tab-icon" src="/public/svg/header/Dashboard.svg" width="50" height="50" alt="" />
                <a>Dashboard</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/faq'">
                <img class="tab-icon" src="/public/svg/header/Questions.svg" width="50" height="50" alt="" />
                <a>Q&A</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/contact'">
                <img class="tab-icon" src="/public/svg/header/Chat.svg" width="50" height="50" alt="" />
                <a>Contact</a>
            </div>

            <div id="account-tab" class="header-tab" onclick="window.location.href='/account/<?php echo $AccountAction ?>'">
                <img class="tab-icon" src="/public/svg/header/Account.svg" width="50" height="50" alt="" />
            </div>
        </div>

        <div class="header-right">
            <button id="language-button" class="third-button" onclick="window.location.href='/account/<?php echo $AccountAction ?>'"><?php echo $AccountText ?></button>
            <button class="language-button">En</button>
        </div>
    </div>
</div>