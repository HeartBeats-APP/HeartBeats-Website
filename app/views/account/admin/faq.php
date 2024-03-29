<link rel="stylesheet" href="/public/css/Popup.css" />
<link rel="stylesheet" href="/public/css/account/faq.css" />
<link rel="stylesheet" href="/public/css/account/badges.css" />


<div class="popupBackground" onclick="window.location.href='/account/admin'"></div>
<div id="PopupCard" class="popupcard">
    <div class="popupcard-header">
        <h3 lang-id="qae_title">Q&A Editor</h3>
        <div class="badge insider">Beta</div>
    </div>
    <div class="column popup-wrapper">

        <div class="new-question" onclick="addNewQuestion()">
            <img src="/public/svg/account/add.svg" alt="">
            Add new question
        </div>

    </div>
    <div class="buttons-row">
        <div class="secondary-button" lang-id="qae_cancel" onclick="window.location.href='/account/admin'">Cancel</div>
        <div class="main-button clickable" lang-id="qae_save" onclick="saveFAQ()">Save</div>
    </div>
</div>

<script src="/public/js/account/faq.js"></script>
<script>
    var data = <?php echo json_encode($data); ?>;
    updateFAQ(data);
</script>
<script src="/public/js/components/translation.js"></script>