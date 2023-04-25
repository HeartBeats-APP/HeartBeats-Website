<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/faq/faq.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>

</head>

<body>

  <div class="wrapper background1">

    <div class="adaptive-margin" style="--coef: 10"></div>
    <!-- Q&A section -->
    <h2 lang-id="faq_title">Frequently Asked Questions</h2>
    <div class="adaptive-margin" style="--coef: 5"></div>

    <div class="animation-wrapper" id="animation-wrapper">
      <div class="animation" id="animation">
        <script>
          var animation = bodymovin.loadAnimation({
            container: document.getElementById('animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/public/json/503.json',
            name: 'Email Sent Animation',
            animationSpeed: 1,
          });
        </script>
      </div>
    </div>

    <script>
      var data = <?php echo json_encode($data); ?>;
      var wrapper = document.querySelector(".wrapper");

      var count = 0;
      for (var i = 0; i < data.length; i++) {
        var details = document.createElement("details");
        var summary = document.createElement("summary");
        var p = document.createElement("p");
        var text = document.createTextNode(data[i].question);
        var text2 = document.createTextNode(data[i].answer);
        var arrow = document.createElement("img");
        arrow.src = "/public/svg/arrow.svg";
        arrow.width = "25";
        arrow.height = "25";
        arrow.alt = "arrow";

        summary.appendChild(text);
        summary.appendChild(arrow);
        p.appendChild(text2);
        details.appendChild(summary);
        details.appendChild(p);
        wrapper.appendChild(details);
        count++;
      }

      if (count > 0) {
        document.querySelector("#animation-wrapper").remove();
      }
    </script>

    <script>
      const detailsElements = document.querySelectorAll('details');

      detailsElements.forEach(function(detailsElement) {
        const summaryElement = detailsElement.querySelector('summary');
        const arrow = summaryElement.querySelector('img');
        const pElement = detailsElement.querySelector('p');

        detailsElement.addEventListener('click', function() {
          detailsElement.open = !detailsElement.open;
          arrowRotate(detailsElement.open, arrow);
        });

        summaryElement.addEventListener('click', function() {
          detailsElement.open = !detailsElement.open;
          arrowRotate(detailsElement.open, arrow);
        });

        pElement.addEventListener('click', function() {
          detailsElement.open = false;
          arrowRotate(detailsElement.open, arrow);
        });

      });

      function arrowRotate(state, element) {
        if (state) {
          element.classList.remove('rotate');
        } else {
          element.classList.add('rotate');
        }
      }
    </script>
  </div>

  <script src="/public/js/components/translation.js"></script>

</body>

</html>