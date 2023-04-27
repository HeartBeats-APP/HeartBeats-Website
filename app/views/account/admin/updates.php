<link rel="stylesheet" href="/public/css/Popup.css" />

<div class="popupBackground" onclick="window.location.href='/account/admin'"></div>
<div id="PopupCard" class="popupcard">
    <div class="popupcard-header">
        <h3><?php echo $data['title'] ?></h3>
    </div>
    <div class="column popup-wrapper">

    </div>
    <div class="buttons-row">
        <div class="secondary-button" lang-id="upd_close" onclick="window.location.href='/account/admin'">Close</div>
        <div class="main-button not-clickable" lang-id="upd_upd">Update</div>
    </div>
</div>

<script>
    var data = <?php echo json_encode($data); ?>;

    var text, status;
    if (data['current_db'] < data['supported_db']) {
        text = "Database can be updated from version " + data['current_db'] + " to version " + data['supported_db'];
        status = false;
    } else if (data['current_db'] >= data['supported_db']) {
        text = "Database is up to date";
        status = true;
    } else {
        text = "Error while checking database version";
        status = false;
    }
    var card = createCard(text, status);
    document.querySelector(".popup-wrapper").appendChild(card);

    var text, status;
    if (data['current_env'] < data['supported_env']) {
        text = "Environment can be updated from version " + data['current_env'] + " to version " + data['supported_env'];
        status = false;
    } else if (data['current_env'] >= data['supported_env']) {
        text = "Environment is up to date";
        status = true;
    } else {
        text = "Error while checking environment version";
        status = false;
    }
    var card = createCard(text, status);
    document.querySelector(".popup-wrapper").appendChild(card);


    function createCard(text, status) {
        var card = document.createElement("div");
        card.classList.add("card");

        var h4 = document.createElement("h4");
        h4.innerHTML = text;
        card.appendChild(h4);

        var toRight = document.createElement("div");
        toRight.classList.add("to-right");
        card.appendChild(toRight);

        var indicator = document.createElement("div");
        indicator.classList.add("indicator");
        if (status == 'true') {
            indicator.classList.add("blue-bg");
        } else {
            indicator.classList.add("red-bg");
        }
        toRight.appendChild(indicator);

        return card;
    }
</script>
<script src="/public/js/components/translation.js"></script>