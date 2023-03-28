<!DOCTYPE html>
<html>

<head>
  <title>HeartBeats</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/public/css/components.css" />
  <link rel="stylesheet" href="/public/css/faq/faq.css" />

</head>

<body>

  <div class="wrapper background1">

    <!-- Q&A section -->
    <h2>Frequently Asked Questions</h2>

    <details>
      <summary>
        Does this product have what I need?
        <img class="control-icon control-icon-expand" src="/public/svg/arrow.svg" alt="up-arrow" width="25" height="25" />
        <img class="control-icon control-icon-close" src="/public/svg/arrow.svg" alt="down-arrow" width="25" height="25" />
      </summary>
      <p>
        Totally. Totally does. <br />
        Totally does. <br />
        Totally does. <br />
        Totally does. <br />
        Totally does. Totally. Totally does.
      </p>
    </details>

    <details>
      <summary>
        Can I use it all the time?
        <img class="control-icon control-icon-expand" src="/public/svg/arrow.svg" alt="up-arrow" width="25" height="25" />
        <img class="control-icon control-icon-close" src="/public/svg/arrow.svg" alt="down-arrow" width="25" height="25" />
      </summary>
      <p>Of course you can, we won't stop you.</p>
    </details>

    <details>
      <summary>
        Are there any restrictions?
        <img class="control-icon control-icon-expand" src="/public/svg/arrow.svg" alt="up-arrow" width="25" height="25" />
        <img class="control-icon control-icon-close" src="/public/svg/arrow.svg" alt="down-arrow" width="25" height="25" />
      </summary>
      <p>Only your imagination my friend. Go forth!</p>
    </details>

    <!-- Js code that allows details to be closed by clicking on it (instead of just clicking the summary) -->
    <script>
      const detailsEls = document.querySelectorAll('details');

      detailsEls.forEach(function(detailsEl) {
        const ulEl = detailsEl.querySelector('p');

        ulEl.addEventListener('click', function() {
          detailsEl.open = false;
        });
      });
    </script>

  </div>
</body>

</html>