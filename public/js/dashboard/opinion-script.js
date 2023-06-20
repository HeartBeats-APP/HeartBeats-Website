$(document).ready(function() {
    $(".like").click(function() {
        sendOpinion(1);
    });

    $(".dislike").click(function() {
        sendOpinion(0);
    });

    function sendOpinion(opinion) {
        var data = {
            "genre": 1,
            "index": 2,
            "opinion": opinion
        };

        $.ajax({
            url: "api/hfpred-opinion",
            type: "POST",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(response) {
                console.log("Requête POST réussie");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur lors de la requête POST: " + textStatus);
            }
        });
    }
});