<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/account/form-card.css" />
  <link rel="stylesheet" href="/public/css/account/login.css" />
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>


<body>

  <div class="wrapper">

    <div class="login-card">
      <div class="section">
        <div class="login-wrapper">

          <div class="login-text">
            <h2 lang-id="log_title">Login to your account</h2>
            <p lang-id="log_sub">Let's jump in.</p>
          </div>

          <!-- Google Sign-In -->
          <div id="g_id_onload" data-client_id="407839619879-b18h6590qstnspu3ku9fs4nhbdhpjdds.apps.googleusercontent.com" data-context="use" data-ux_mode="popup" data-login_uri="https://heart-beats.fr/account/googleAuth" data-auto_select="true" data-close_on_tap_outside="false" data-itp_support="true">
          </div>
          <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="filled_black" data-text="continue_with" data-size="large" data-logo_alignment="left">
          </div>

          <div class="login-field">
            <label for="">Email</label>
            <input id="email" type="email" placeholder="guest@heart-beats.fr" spellcheck="false" autocomplete="on" required>
            <a id="email-warning-message" class="warning-message"></a>
          </div>

          <div class="login-field">
            <label lang-id="log_pwt" for="">Password</label>
            <input id="password" type="password" placeholder="**********" spellcheck="false" autocomplete="on" required>
            <a id="password-warning-message" class="warning-message"></a>
            <div class="show-password">
              <input type="checkbox" id="show-password-input" onclick="showPassword()" /><label for="show-password-input"></label>
              <p lang-id="log_spw" class="connected-text">Show password</p>
            </div>
          </div>

          <a lang-id="log_fpw" class="change-password" href="/account/changePassword">Forgot password?</a>

          <div class="buttons-area">
            <button lang-id="log_log_but" onclick="login()" class="main-button">Login</button>
            <button lang-id="log_reg_but" onclick="window.location.href='/account/register'" class="secondary-button">Register instead</button>
          </div>

        </div>
        <img class="section-img" src="/public/png/login-1.png" alt="login-image">
      </div>
    </div>
  </div>

  <script src="/public/js/account/entries-checker.js"></script>

</body>

</html>