/* This file contains the header, modify the html code below to modify the header */

document.write(`

<link rel="stylesheet" href="/header/header.css"/>

<div class="header">
    <div class="header-left">
        <img onclick="window.location.href='/index.html'" src="/images/Logo.svg" alt="HeartBeats Logo" />
        <a href="/dashboard.html">Dashboard</a>
        <a href="/q&a.html">Q&A</a>
        <a href="/contact.html">Contact</a>
    </div>
    <div class="header-right">
        <button onclick="window.location.href='/account/login.html'" class="second-button orange">Login</button>
        <button class="language-button">En</button>
    </div>
</div>


`);