function expand(card){
    card.classList.toggle('large');

    var div = document.getElementById('overlay-bg');
    div.classList.toggle('overlay-bg');
    div.addEventListener('click', function () {
        expand(card);
    });

    var children = card.children;
    for (var i = 1; i < children.length; i++) {
        children[i].classList.toggle('hidden');
    }

    var id = card.id;
    document.getElementById(id + '-expanded').classList.toggle('hidden');
}

function getUpdatesInfos(){
    var request = new XMLHttpRequest();
    request.open("GET", "/account/getUpdatesInfos", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            return this.responseText;
        }
    };
    request.send();
}