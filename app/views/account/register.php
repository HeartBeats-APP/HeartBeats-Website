<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/css/components/componentsV2.css" />
  <link rel="stylesheet" href="css/form-card.css" />
  <link rel="stylesheet" href="css/register.css" />
  <link rel="stylesheet" href="css/password-recovery.css" />

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>

</head>

<body>
  <div class="login-background"></div>

  <div class="wrapper">

    <!-- Header -->
    <script src="/Header/header.js"></script>

    <div class="login-card">
      <div id="card-content" class="login-wrapper">

        <div class="login-text">
          <h1 id="title">Create an account</h1>
          <p id="subtitle">Welcome aboard.</p>
        </div>

        <!-- Email animation -->
        <div class="animation-wrapper">

          <div class="email-animation" id="email-animation">

            <script>
              var animation = bodymovin.loadAnimation({
                container: document.getElementById('email-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'json/email-sent-animation.json',
                name: 'Email Sent Animation',
                animationSpeed: 0.5,
              });
            </script>

          </div>
        </div>
        <style>
          .email-animation {
            display: none;
          }
        </style>
        <!-- Email animation ends here -->

        <form id="register-form" action="" method="POST">

          <div class="login-field">
            <label for="">Name</label>
            <input type="text" id="name" placeholder="Matthew" spellcheck="on" autocomplete="on">
            <a id="name-warning-message" class="warning-message"></a>
          </div>

          <div class="login-field">
            <label for="">Email</label>
            <input type="email" id="email" placeholder="guest@heart-beats.fr" spellcheck="false" autocomplete="on">
            <a id="email-warning-message" class="warning-message"></a>
          </div>

          <div class="show-password">
            <input type="checkbox" id="show-password-input" onclick="showPassword()" /><label
              for="show-password-input"></label>
            <p class="connected-text">Show passwords</p>
          </div>
          <div class="login-field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="**********" spellcheck="false"
              autocomplete="on">
            <a id="password-warning-message" class="warning-message"></a>
          </div>

          <!-- Password strength indicator -->
          <div class="strength-indicator">
            <meter max="4" id="password-strength-meter"></meter>
            <p id="password-strength-text"></p>
          </div>


          <div class="login-field" id="confirm-password">
            <label for="">Confirm password</label>
            <input type="password" id="password-confirmation" placeholder="**********" spellcheck="false"
              autocomplete="on">
            <a id="passwordConfirm-warning-message" class="warning-message"></a>
          </div>
        </form>

        <div id="buttons-area" class="buttons-area">
          <button onclick="createAccount()" class="main-button g-recaptcha" type="submit" form="register-form"
            data-sitekey="6LcDxpkkAAAAAE4Jdj3-JZD6ugtBsZjdeEtfz5I5" data-callback="createAccount"
            data-action='submit'>Create</button>
          <button onclick="window.location.href='login.html'" class="secondary-button">Login instead</button>
        </div>

      </div>

    </div>
  </div>

  <script src="js/entries-checker.js"></script>
  <script src="js/zxcvbn.js"></script>
  <script src="js/password-strength-checker.js"></script>

  <script>
    if (localStorage.getItem("connected") == "true") {
      document.href = "user.html";
    }
  </script>
  
</body>

</html>