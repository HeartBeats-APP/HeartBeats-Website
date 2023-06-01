<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/account/form-card.css" />

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>

</head>

<body>
  <div class="login-background"></div>

  <div class="wrapper">

    <div class="login-card">
      <div id="card-content" class="login-wrapper">

        <div class="login-text">
          <h1 id="title" lang-id="ver_tit" >Account verified</h1>
          <p id="subtitle" lang-id="ver_sub">You're ready to go</p>
        </div>

        <!-- Animation -->
        <div class="animation-wrapper">

          <div class="email-animation" id="email-animation">

            <script>
              var animation = bodymovin.loadAnimation({
                container: document.getElementById('email-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '/public/json/account-created-animation.json',
                name: 'Email Sent Animation',
                animationSpeed: 1,
              });
            </script>

          </div>
        </div>
        <!-- Animation ends here -->      

        <div id="buttons-area" class="buttons-area">
          <button onclick="window.location.href='/dashboard'" class="main-button">Dashboard</button>
          <button onclick="window.location.href='/home'" class="secondary-button">Home</button>
        </div>

      </div>

    </div>
  </div>
  <script src="/public/js/components/translation.js"></script>

</body>

</html>