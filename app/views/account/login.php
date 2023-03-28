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
      <div class="login-wrapper">

        <div class="login-text">
          <h2>Login to your account</h2>
          <p>Let's jump in.</p>
        </div>

        <div class="login-field">
          <label for="">Email</label>
          <input id="email" type="email" placeholder="guest@heart-beats.fr" spellcheck="false" autocomplete="on" required>
          <a id="email-warning-message" class="warning-message"></a>
        </div>

        <div class="login-field">
          <label for="">Password</label>
          <input id="password" type="password" placeholder="**********" spellcheck="false" autocomplete="on" required>
          <div class="show-password">
            <input type="checkbox" id="show-password-input" onclick="showPassword()"/><label for="show-password-input"></label>
            <p class="connected-text">Show password</p>
          </div>
          <a id="password-warning-message" class="warning-message"></a>
        </div>

        <div class="stay-connected">
          <input type="checkbox" id="switch" /><label for="switch"></label>
          <p class="connected-text">Stay connected</p>
          <a href="/account/changePassword">Forgot password?</a>
        </div>

        <div class="buttons-area">
          <button onclick="login()" class="main-button">Login</button>
          <button onclick="window.location.href='/account/register'" class="secondary-button">Register instead</button>
        </div>

      </div>

    </div>
  </div>

  <script src="/public/js/account/entries-checker.js"></script>

</body>

</html>