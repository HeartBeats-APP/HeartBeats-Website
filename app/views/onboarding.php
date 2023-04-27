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

            <h3 lang-id="onb_p1">Thank you for joining the release preview</h3>
            <p lang-id="onb_p2">Our website is still in preview, and we are working hard to make it perfect</p>
            <p lang-id="onb_p3">More updates are coming soon 🚀</p>

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
                            name: 'Onboarding Animation',
                            animationSpeed: 1,
                        });
                    </script>
                </div>
            </div>
            <!-- Animation ends here -->
            <div class="main-button" onclick="hideOnboarding()" lang-id="onb_jin">Jump in</div>
        </div>
    </div>

</body>
<script>
function hideOnboarding() {
    localStorage.setItem("onboarding", "true");
    parent.document.getElementById("onboarding").remove();
}

</script>