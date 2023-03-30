<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/index.css" />
  <link rel="stylesheet" href="/public/css/onboarding.css" />

</head>

<body id="index-body">

  <iframe id="onboarding" class="onboarding" src="/app/views/onboarding.php" frameborder="0" allowTransparency="true"></iframe>
  <div class="background3"></div>
  <!-- Wrapper, contains the whole page and add margins to the sides -->
  <div class="wrapper ">

    <div class="column">
      <h1>HeartBeats</h1>
      <h5>Music that adapts to you.</h5>
    </div>

  </div>


</body>

<script>
  if (localStorage.getItem("onboarding") == "true") {
    document.getElementById("onboarding").remove();
  }


  window.onscroll = function() {
    if (localStorage.getItem("onboarding") == "true") {
      return;
    }
    window.scrollTo(0, 0);
  };

  window.ontouchmove = function() {
    if (localStorage.getItem("onboarding") == "true") {
      return;
    }
    window.scrollTo(0, 0);
  };
</script>

</html>