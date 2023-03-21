<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/css/components/componentsV2.css" />
  <link rel="stylesheet" href="css/form-card.css" />
  <link rel="stylesheet" href="css/login.css" />

</head>

<body>

  <div class="wrapper">

    <!-- Header -->
    <script src="/Header/header.js"></script>

    <div class="login-card">
      <div class="login-wrapper">

        <div class="login-text">
          <h1>Login to your account</h1>
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
          <a href="password-recovery.html">Forgot password?</a>
        </div>

        <div class="buttons-area">
          <button onclick="login()" class="main-button">Login</button>
          <button onclick="window.location.href='register.html'" class="secondary-button">Register instead</button>
        </div>

      </div>

    </div>
  </div>

  <script src="js/entries-checker.js"></script>

  <script>
    if (localStorage.getItem("email") != "" && localStorage.getItem("email") != null) {
      document.getElementById("email").value = localStorage.getItem("email");
    }
    if (localStorage.getItem("connected") == "true") {
      document.href = "/account/user.html";
    }
    
  </script>
</body>

</html>