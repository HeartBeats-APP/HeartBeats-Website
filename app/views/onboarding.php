<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/public/css/components.css" />
    <link rel="stylesheet" href="/public/css/onboarding.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>
    <script src="/public/js/onboarding.js"></script>
</head>

<body id="onboarding-body">

    <div class="onboarding-bg">
        <div class="onboarding-card">

            <h3>Thanks for joining the preview!</h3>
            <p> HeartBeats is currently in preview. We're working hard to make it better. </p>
            <!-- Animation -->
            <div class="animation-wrapper">
                <div class="email-animation" id="animation">

                    <script>
                        var animation = bodymovin.loadAnimation({
                            container: document.getElementById('animation'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: '/public/json/Onboarding.json',
                            name: 'Email Sent Animation',
                            animationSpeed: 1,
                        });
                    </script>
                </div>
            </div>
            <!-- Animation ends here -->
            <div class="main-button" onclick="hideOnboarding()">Great!</div>
        </div>
    </div>

</body>
<script>
function hideOnboarding() {
    localStorage.setItem("onboarding", "true");
    parent.document.getElementById("onboarding").remove();
}

</script>