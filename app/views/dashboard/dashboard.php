<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/public/css/dashboard/dashboardStyle.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <div class="background"></div>
    <div class="welcome-banner">
        <h1>Welcome Back <?php echo $data['name'] ?></h1>
    </div>
    <div class="dashboard-box playing-music-box">
        <div class="now-playing">
            <h2>Now playing</h2>
            <p class="music-title">Song title</p>
            <div class="progress-bar"></div>
        </div>
        <div class="dashboard-controls">
            <button class="dashboard-btn play-button">Play</button>
            <button class="dashboard-btn pause-button">Pause</button>
            <button class="dashboard-btn next-button">Next</button>
            <button class="dashboard-btn like-button">Like</button>
            <button class="dashboard-btn dislike-button">Dislike</button>
        </div>
    </div>
    <div class="dashboard-box listening-stats-box">
        <div class="listening-stats">
            <h2>Listening statistics</h2>
            <p>Listening time: 1 hour and 30 minutes</p>
        </div>
    </div>
</body>
</html>