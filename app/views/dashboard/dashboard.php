<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/public/css/dashboard/dashboardStyle.css"/>
    <script src="/header/header.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Mobile styles */
        @media screen and (min-width: 760px) and (max-width: 920px) {
            .welcome-banner {
                margin-top: 20%;
            }
            .now-playing, .listening-stats {
                padding: 20px;
            }
            .listening-stats-box {
                margin-top: 7%;
                padding: 5%;
                font-size: 20px;
            }
        }
        @media screen and (min-width: 500px) and (max-width: 750px) {
            button {
                padding: 3%;
                font-size: 16px;
            }
        }
        @media only screen and (max-width: 480px) {
            .welcome-banner {
                margin-left: 0;
            }
            .welcome-banner h1 {
                font-size: 30px;
            }
            .dashboard-box {
                width: 90%;
            }
            .now-playing, .listening-stats {
                padding: 20px;
            }
            .dashboard-controls {
                flex-wrap: wrap;
            }
            .dashboard-controls button {
                margin: 5px;
            }
        }
        @media only screen and (max-width: 400px) {
            .welcome-banner {
                margin-top: -2%;
            }
            .dashboard-box {
                margin-top: 5%;
            }
            .now-playing, .listening-stats {
                padding: 0;
            }
        }
        @media only screen and (max-width: 395px) {
            .now-playing, .listening-stats {
                padding: 7%;
            }
        }
        @media only screen and (max-width: 375px) {
            .now-playing, .listening-stats {
                padding: 0%;
            }
            .playing-music-box {
                margin-top: -2%;
            }
        }
        @media screen and (max-width: 360px) {
            .listening-stats-box {
                margin-top: 7%;
                padding: 10%;
            }
        }
        @media screen and (max-width: 300px) {
            .welcome-banner h1 {
                font-size: 18px;
            }
            .dashboard-box {
                margin-top: 5%;
            }
            .listening-stats {
                font-size: 12px;
            }
            button {
                padding: 5%;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="welcome-banner">
        <h1>Welcome back Ivan!</h1>
    </div>
    <div class="dashboard-box playing-music-box">
        <div class="now-playing">
            <h2>Now playing</h2>
            <p class="music-title">Song title</p>
            <div class="progress-bar"></div>
        </div>
        <div class="dashboard-controls">
            <button class="play-button">Play</button>
            <button class="pause-button">Pause</button>
            <button class="next-button">Next</button>
            <button class="like-button">Like</button>
            <button class="dislike-button">Dislike</button>
        </div>
    </div>
    <div class="dashboard-box listening-stats-box">
        <div class="listening-stats">
            <h2>Listening statistics</h2>
            <p>Listening time: 1 hour and 30 minutes</p>
            <p>Comparison to yesterday: +20%</p>
        </div>
    </div>
</body>
</html>