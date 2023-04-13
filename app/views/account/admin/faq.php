<link rel="stylesheet" href="/public/css/Popup.css" />
<link rel="stylesheet" href="/public/css/account/faq.css" />
<link rel="stylesheet" href="/public/css/account/badges.css" />


<div class="popupBackground" onclick="window.location.href='/account/admin'"></div>
<div id="PopupCard" class="popupcard">
    <div class="popupcard-header">
        <h3>Q&A Editor</h3>
        <div class="badge insider">Beta</div>
    </div>
    <div class="column popup-wrapper">


    </div>
    <div class="buttons-row">
        <div class="secondary-button" onclick="window.location.href='/account/admin'">Cancel</div>
        <div class="main-button clickable" onclick="saveFAQ()">Save</div>
    </div>
</div>

<script src="/public/js/account/faq.js"></script>
<script>
    var data = <?php echo json_encode($data); ?>;
    updateFAQ(data);
</script>