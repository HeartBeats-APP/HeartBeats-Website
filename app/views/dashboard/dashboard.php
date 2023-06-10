<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="public/css/dashboard/dashboardStyle.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <div class="content-wrapper">
        <div class="background"></div>
        <div class="welcome-banner">
            <h1>Welcome back <?php echo $data['name'] ?>!</h1>
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
            </div>
        </div>

        <div class="dashboard-box">
            <div class="graph-container" id="graph-container">
                <div class="graph top-left">
                    <div class="graph-content">
                        <canvas id="temperature-chart"></canvas>
                    </div>
                </div>
                <div class="graph top-right">
                    <div class="graph-content">
                        <canvas id="humidity-chart"></canvas>
                    </div>
                </div>
                <div class="graph bottom-left">
                    <div class="graph-content">
                        <canvas id="sound-level-chart"></canvas>
                    </div>
                </div>
                <div class="graph bottom-right">
                    <div class="graph-content">
                        <canvas id="bpm-level-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="public/js/dashboard/dashboard-script.js"></script>
<script src="/public/js/components/translation.js"></script>

</html>