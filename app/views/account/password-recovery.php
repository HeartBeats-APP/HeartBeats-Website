<!DOCTYPE html>
<html>

<head>
    <title>HeartBeats</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/public/css/components.css" />
    <link rel="stylesheet" href="/public/css/account/form-card.css" />
    <link rel="stylesheet" href="/public/css/account/password-recovery.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>


</head>

<body>
    <div class="login-background"></div>*

    <div class="wrapper">

        <div class="login-card">
            <div id="login-wrapper" class="login-wrapper">

                <div class="login-text">
                    <h2 id="title" lang-id="pwr_title">Lost your password?</h2>
                    <p id="subtitle" lang-id="pwr_sub">We're here to help.</p>
                </div>

                <div id="login-field" class="login-field">
                    <label for="">E-mail</label>
                    <input type="email" id="email" placeholder="guest@heart-beats.fr" spellcheck="false" autocomplete="on" >
                    <a id="email-warning-message" class="warning-message"></a>
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

                <div id="buttons-area" class="buttons-area">
                    <div onclick="recoverPassword()" class="main-button" id="submit-button-passwordRecovery"
                         lang-id="pwr_snd">Send email</div>
                </div>

            </div>

        </div>
    </div>

    <script src="/public/js/account/entries-checker.js"></script>
    <script>
        if (localStorage.getItem("email") != "" && localStorage.getItem("email") != null) {
          document.getElementById("email").value = localStorage.getItem("email");
        }
    </script>
    <script src="/public/js/components/translation.js"></script>

</body>

</html>