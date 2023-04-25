<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/account/form-card.css" />
  <link rel="stylesheet" href="/public/css/account/login.css" />
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

        <div class="login-field">
          <label for="">E-mail</label>
          <input id="email" type="email" placeholder="guest@heart-beats.fr" spellcheck="false" autocomplete="on" required>
          <a id="email-warning-message" class="warning-message"></a>
        </div>

        <div class="login-field">
          <label for="" lang-id="log_pwt">Password</label>
          <input id="password" type="password" placeholder="**********" spellcheck="false" autocomplete="on" required>
          <a id="password-warning-message" class="warning-message"></a>
          <div class="show-password">
            <input type="checkbox" id="show-password-input" onclick="showPassword()" /><label
              for="show-password-input"></label>
            <p class="connected-text" lang-id="log_spw" >Show password</p>
          </div>


        <div class="stay-connected">
          <input type="checkbox" id="switch" /><label for="switch"></label>
          <p class="connected-text" lang-id="log_stc">Stay connected</p>
        </div>
        <a href="/account/changePassword" lang-id="log_fpw">Forgot password?</a>

        <div class="buttons-area">
          <button onclick="login()" class="main-button" lang-id="log_log_but" >Login</button>
          <button onclick="window.location.href='/account/register'" class="secondary-button"
                  lang-id="log_reg_but" >Register instead</button>
        </div>


        </div>
        <img class="section-img" src="/public/png/login-1.png" alt="login-image">
      </div>
    </div>
  </div>

  <script src="/public/js/account/entries-checker.js"></script>
  <script src="/public/js/components/translation.js"></script>

</body>

</html>