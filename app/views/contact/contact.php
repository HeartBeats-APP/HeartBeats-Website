<!DOCTYPE html>
<html>

<head>
    <title>HeartBeats</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/public/css/components.css" />
    <link rel="stylesheet" href="/public/css/contact/contact.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>

</head>

<body>

    <div class="wrapper background1">

        <div class="assistance-card">
            <div class="text-wrapper">

                <h3>Need assistance?</h3>
                <p>We're here to help, feel free to contact us</p>

            </div>
            <div class="icon-wrapper">
                <img class="assistance-icon" src="/public/svg/full-arrow.svg" alt="Assistance Icon" />
            </div>
        </div>
        <div class="feedback-card">

            <h3 id="title">Send feedback</h3>
            <p id="subtitle">If you need to tell us something, it's here</p>

            <div id="input-fields">
                <div class="adaptive-margin" style="--coef: 3"></div>
                <input class="title-field" id="title" type="text" placeholder="Title" spellcheck="false" autocomplete="off">
                <div id="title-error-message" class="error-message"></div>

                <div class="adaptive-margin" style="--coef: 3"></div>

                <textarea class="text-field" id="message" placeholder="Write your message here" cols="30" rows="10" autocomplete="off" spellcheck="true"></textarea>
                <div id="text-error-message" class="error-message"></div>
                <div class="buttons-area">
                    <button class="main-button" onclick="sendFeedback()">Send</button>
                </div>
            </div>

            <!-- Send animation -->
            <div class="animation-wrapper">

                <div class="animation" id="animation">

                    <script>
                        var animation = bodymovin.loadAnimation({
                            container: document.getElementById('animation'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: '/public/json/sended.json',
                            name: 'Message Sent Animation',
                            animationSpeed: 1,
                        });
                    </script>

                </div>
            </div>

            <style>
                .animation {
                    display: none;
                }
            </style>
            <!--  Animation ends here -->

        </div>
    </div>

    <script src="/public/js/contact/feedback.js"></script>
</body>

</html>