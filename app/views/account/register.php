<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/account/form-card.css" />
  <link rel="stylesheet" href="/public/css/account/register.css" />
  <link rel="stylesheet" href="/public/css/account/password-recovery.css" />

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>

</head>

<body>
  <div class="login-background"></div>

  <div class="wrapper">

    <div class="login-card">
      <div class="section" id="section">
        <div id="card-content" class="login-wrapper">

          <div class="login-text">
            <h2 id="title">Create an account</h2>
            <p id="subtitle">Welcome aboard.</p>
          </div>

          <!-- Google Sign-In -->
          <div id="g_id_onload" data-client_id="407839619879-b18h6590qstnspu3ku9fs4nhbdhpjdds.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="http://localhost:8000" data-auto_select="true" data-close_on_tap_outside="false" data-itp_support="true">
          </div>

          <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="filled_black" data-text="continue_with" data-size="large" data-logo_alignment="left" data-width="100">
          </div>

          <!-- Email animation -->
          <div class="animation-wrapper" id="email-animation">

            <div class="animation">

              <script>
                var animation = bodymovin.loadAnimation({
                  container: document.getElementById('email-animation'),
                  renderer: 'svg',
                  loop: true,
                  autoplay: true,
                  path: '/public/json/email-sent.json',
                  name: 'Email Sent Animation',
                });
              </script>

            </div>
          </div>
          <style>
            .animation-wrapper {
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
              <input type="checkbox" id="show-password-input" onclick="showPassword()" /><label for="show-password-input"></label>
              <p class="connected-text">Show passwords</p>
            </div>
            <div class="login-field">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="**********" spellcheck="false" autocomplete="on">
              <a id="password-warning-message" class="warning-message"></a>
            </div>

            <!-- Password strength indicator -->
            <div class="strength-indicator">
              <meter max="4" id="password-strength-meter"></meter>
              <p id="password-strength-text"></p>
            </div>


            <div class="login-field" id="confirm-password">
              <label for="">Confirm password</label>
              <input type="password" id="password-confirmation" placeholder="**********" spellcheck="false" autocomplete="on">
              <a id="passwordConfirm-warning-message" class="warning-message"></a>
            </div>
          </form>

          <div id="buttons-area" class="buttons-area">
            <button id="create-account-button" onclick="createAccount()" class="main-button g-recaptcha" type="submit" form="register-form" data-sitekey="6LcDxpkkAAAAAE4Jdj3-JZD6ugtBsZjdeEtfz5I5" data-callback="createAccount" data-action='submit'>Create</button>
            <button id="login-button" onclick="window.location.href='/account/login'" class="secondary-button">Login instead</button>
          </div>
        </div>

        <img id="section-img" class="section-img" src="/public/svg/register-1.svg" alt="">

      </div>
    </div>
  </div>

  <script src="/public/js/account/entries-checker.js"></script>
  <script src="/public/js/account/zxcvbn.js"></script>
  <script src="/public/js/account/password-strength-checker.js"></script>
  
    <!-- Initialize the Google Sign-In functionality -->
    <script>
    window.onload = function() {
      google.accounts.id.initialize({
        client_id: '407839619879-b18h6590qstnspu3ku9fs4nhbdhpjdds.apps.googleusercontent.com',
        callback: handleCredentialResponse
      });
    };

    function handleCredentialResponse(response) {
      // Handle the response from Google Sign-In
      console.log(response.credential);
    }
  </script>

</body>

</html>