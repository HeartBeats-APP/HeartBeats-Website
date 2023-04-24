<!DOCTYPE html>

<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/dashboard/dashboardStyle.css" />
    <script src="/header/header.js"></script>
    <style>
        /* Mobile styles */
        @media only screen and (max-width: 480px) {
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
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="welcome-banner">
        <h1>Welcome back Ivan!</h1>
    </div>
    <div class="dashboard-box">
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
    <div class="dashboard-box">
        <div class="listening-stats">
            <h2>Listening statistics</h2>
            <p>Listening time: 1 hour and 30 minutes</p>
            <p>Comparison to yesterday: +20%</p>
        </div>
    </div>
</body>
</html>