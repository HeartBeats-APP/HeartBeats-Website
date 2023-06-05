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
                <a lang-id="hed_dash" dashboard>Dashboard</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/faq'">
                <img class="tab-icon" src="/public/svg/header/Questions.svg" width="50" height="50" alt="" />
                <a lang-id="hed_qna">Q&A</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/contact'">
                <img class="tab-icon" src="/public/svg/header/Chat.svg" width="50" height="50" alt="" />
                <a>Contact</a>
            </div>

            <div class="header-tab" onclick="window.location.href='/slides/'">
                <img class="tab-icon" src="/public/svg/header/Slides.svg" width="50" height="50" alt="" />
                <a lang-id="hed_sli">Slides</a>
            </div>  

            <div id="account-tab" class="header-tab" onclick="window.location.href='/account/<?php echo $AccountAction ?>'">
                <img class="tab-icon" src="/public/svg/header/Account.svg" width="50" height="50" alt="" />
            </div>

        </div>

        <div class="header-right">
            <button id="language-button" class="third-button" onclick="window.location.href='/account/<?php echo $AccountAction ?>'"><?php $AccountText;
                echo $AccountText ?></button>
            <button id="translate-button" class="language-button" lang-id="hed_tra">En</button>
        </div>
    </div>
</div>

