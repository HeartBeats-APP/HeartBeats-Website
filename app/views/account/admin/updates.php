<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/public/css/components.css"/>
    <link rel="stylesheet" href="/public/css/account/security.css"/>
</head>

<body class="column card-body">

    <h2>Updates</h2>

</body>

<script src="/public/js/account/admin.js"></script>
<script>
    var results = getUpdatesInfos();
    if (results == false){
        window.location.href = "/account";
        return;
    }

    var current_db = results['current_db'];
    var supported_db = results['supported_db'];
    var current_env = results['current_env'];
    var supported_env = results['supported_env'];


</script>