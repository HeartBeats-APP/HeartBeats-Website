<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>HeartBeats</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/home/homeStyle.css">
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/index.css" />
  <link rel="stylesheet" href="/public/css/onboarding.css" />
</head>

<body>

  <iframe id="onboarding" class="onboarding" src="/app/views/onboarding.php" frameborder="0" allowTransparency="true"></iframe>

  <main>
    <section class="intro animate">
      <div class="pink-gradient-bg"></div>
      <h1>Heart Beats</h1>
      <h2>Music that adapts to you</h2>
    </section>

    <section class="pulse animate">
      <div class="introducing">
        <p>Introducing</p>
        <h3>Pulse 1</h3>
        <img src="/public/png/headphone-facing-screen.png" alt="pulse 1" class="pulse-image">
      </div>
    </section>

    <section class="pulse-info animate">
      <div class="pulse-content">
        <p>Pulse 1 is a headset with various sensors built-in which allow continuous measurements of user's surrounding.
          Data is reviewed with on-device processing and used for tuning automatically the audio to provide a new sound experience.
          Enhanced.</p>
      </div>
    </section>

    <section class="adaptive-sound animate">
      <div class="adaptive-sound-bg"></div>
      <div class="adaptive-sound-image-container">
        <img src="/public/png/headphone-1-ear.png" alt="adaptive sound" class="adaptive-sound-image">
        <img src="/public/png/sound-wave.png" alt="sound wave" class="sound-wave-image">
        <img src="/public/png/volume-control-icon.png" alt="volume control" class="volume-control-image">
      </div>
      <div class="adaptive-sound-info">
        <h1>Groundbreaking technologies</h1>
        <h2>Adaptive Sound</h2>
        <div class="adaptive-sound-content">
          <p>Adaptive Sound is a proprietary technology that aims to improve the audio experience to an astounding level.</p>
          <p>Adaptive Sound is made of powerful algorithms that takes 15+ entries to determine how the sound should be enhanced.</p>
          <p>The headset is measuring itself various factors such as circadian rhythm, time, weather, activity.</p>
        </div>
      </div>
    </section>

    <section class="animate">
      <div class="adaptive-sound-info-2">
        <h2>Cutting-edge sensors</h2>
        <h3>And so much more...</h3>
      </div>
      <div class="adaptive-sound-sensors-container">
        <div class="sensor-container">
          <div class="sensor-box">
            <p>Heart Rate</p>
            <img src="/public/png/bpm-icon.png" alt="heart rate icon" class="sensor-icon">
          </div>
          <div class="sensor-box">
            <p>Air Temperature</p>
            <img src="/public/png/temp-icon.png" alt="air temperature icon" class="sensor-icon">
          </div>
          <div class="sensor-box">
            <p>Ambient Noise</p>
            <img src="/public/png/sound-icon.png" alt="ambient noise icon" class="sensor-icon">
          </div>
          <div class="sensor-box">
            <p>Air Humidity</p>
            <img src="/public/png/humidity-icon.png" alt="air humidity icon" class="sensor-icon">
          </div>
        </div>
      </div>
    </section>

    <section class="control-section animate">
      <div class="blue-security-bg"></div>
      <img src="/public/png/11076-tnoinb3x-removebg-preview-1.png" alt="overlay" class="overlay-image">
      <h3 class="control-title">You're in control.</h3>
      <h4 class="control-subtitle">Secure by Design.</h4>
      <div class="control-box">
        <h3 class="control-box-title">Encrypted database</h5>
          <p>Your data is synced and securely stored on our side.</p>
      </div>
      <div class="control-box">
        <h3 class="control-box-title">On-device processing</h5>
          <p>Sensible data never leaves your device and is deleted after a short time.</p>
      </div>
      <div class="control-box">
        <h3 class="control-box-title">Encapsulation</h5>
          <p>Data is encapsulated while in transit to ensure a safe and reliable transfer.</p>
      </div>
    </section>

  </main>
  <script src="/public/js/home/script.js"></script>

</body>

<script>
  if (localStorage.getItem("onboarding") == "true") {
    document.getElementById("onboarding").remove();
  }
  window.onscroll = function() {
    if (localStorage.getItem("onboarding") == "true") {
      return;
    }
    window.scrollTo(0, 0);
  };
  window.ontouchmove = function() {
    if (localStorage.getItem("onboarding") == "true") {
      return;
    }
    window.scrollTo(0, 0);
  };
</script>

</html>