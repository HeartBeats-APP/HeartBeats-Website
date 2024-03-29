<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>HeartBeats</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/home/homeStyle.css">
  <link rel="stylesheet" href="/public/css/home/orb-styles.css">
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/onboarding.css" />

  <script type="module" src="/public/js/home/orb-animation.js"></script>
  
</head>

<iframe id="onboarding" class="onboarding" src="/app/views/onboarding.php" frameborder="0" allowTransparency="true"></iframe>

  <main>
    <div class="content-wrapper">
      <section class="intro animate">
        <canvas class="orb-canvas"></canvas>
        <div class="pink-gradient-bg"></div>
        <h1>HeartBeats</h1>
        <h2 lang-id="hom_slg">Music that adapts to you</h2>
      </section>

      <section class="pulse">
        <div class="introducing">
          <p lang-id="hom_int">Introducing</p>
          <h3>Pulse 1</h3>
          <img src="/public/png/headphone-facing-screen.png" alt="pulse 1" class="pulse-image">
        </div>
      </section>

      <section class="pulse-info">
        <div class="pulse-content">
          <p lang-id="hom_p1d">Pulse 1 is a headset with various sensors built-in which allow continuous measurements of user's surrounding.
            Data is reviewed with on-device processing and used for tuning automatically the audio to provide a new sound experience.
            Enhanced.</p>
        </div>
      </section>

      <section class="groundbreaking-part animate">
        <div class="adaptive-sound-bg"></div>
        <div class="adaptive-sound-image-container">
          <img src="/public/png/headphone-1-ear.png" alt="adaptive sound" class="adaptive-sound-image">
          <img src="/public/png/sound-wave.png" alt="sound wave" class="sound-wave-image">
          <img src="/public/png/volume-control-icon.png" alt="volume control" class="volume-control-image">
        </div>
        <div class="adaptive-sound-info">
          <h1 lang-id="hom_gbt">Groundbreaking technologies</h1>
          <h2 lang-id="hom_ads">Adaptive Sound</h2>
          <div class="adaptive-sound-content">
            <p lang-id="hom_as1">Adaptive Sound is a proprietary technology that aims to improve the audio experience to an astounding level.</p>
            <p lang-id="hom_as2">Adaptive Sound is made of powerful algorithms that takes 15+ entries to determine how the sound should be enhanced.</p>
            <p lang-id="hom_as3">The headset is measuring itself various factors such as circadian rhythm, time, weather, activity.</p>
          </div>
        </div>
      </section>

      <section class="animate">
        <div class="adaptive-sound-info-2">
          <h2 lang-id="hom_ces">Cutting-edge sensors</h2>
          <h3 lang-id="hom_asm">And so much more...</h3>
        </div>
        <div class="adaptive-sound">
          <div class="sensor-container">
            <div class="sensor-box">
              <p lang-id="hom_shr">Heart Rate</p>
              <img src="/public/png/bpm-icon.png" alt="heart rate icon" class="sensor-icon">
            </div>
            <div class="sensor-box">
              <p lang-id="hom_sat">Air Temperature</p>
              <img src="/public/png/temp-icon.png" alt="air temperature icon" class="temp-sensor-icon">
            </div>
            <div class="sensor-box">
              <p lang-id="hom_san">Ambient Noise</p>
              <img src="/public/png/sound-icon.png" alt="ambient noise icon" class="sensor-icon">
            </div>
            <div class="sensor-box">
              <p lang-id="hom_sah">Air Humidity</p>
              <img src="/public/png/humidity-icon.png" alt="air humidity icon" class="sensor-icon">
            </div>
          </div>
        </div>
      </section>

      <section class="control-section animate">
        <div class="blue-security-bg"></div>
        <img src="/public/png/11076-tnoinb3x-removebg-preview-1.png" alt="overlay" class="overlay-image">
        <h3 class="control-title" lang-id="hom_yic">You're in control.</h3>
        <h4 class="control-subtitle" lang-id="hom_sbd">Secure by Design.</h4>
        <div class="control-box">
          <h3 class="control-box-title" lang-id="hom_edb">Encrypted database</h3>
          <p lang-id="hom_ed2">Your data is synced and securely stored on our side.</p>
        </div>
        <div class="control-box">
          <h3 class="control-box-title" lang-id="hom_odp">On-device processing</h3>
          <p lang-id="hom_op2">Sensible data never leaves your device and is deleted after a short time.</p>
        </div>
        <div class="control-box">
          <h3 class="control-box-title" lang-id="hom_enc">Encapsulation</h3>
          <p lang-id="hom_en2">Data is encapsulated while in transit to ensure a safe and reliable transfer.</p>
        </div>
      </section>
    </div>
  </main>

  <script src="/public/js/home/orb-animation.js"></script>
  <script src="/public/js/home/script.js"></script>
  <script src="/public/js/components/translation.js"></script>

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