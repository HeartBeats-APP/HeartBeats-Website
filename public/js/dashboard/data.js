function getSensorsData(){

    var request = new XMLHttpRequest();
    request.open("GET", "dashboard/getData", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            answer = JSON.parse(this.responseText);

            if (answer != true) {
                alert("Error while getting data from the server");
                return;
            }
            
            BPM = answer.BPM;
            Sound = answer.Sound;
            Temp = answer.Temp;
            Humidity = answer.Humidity;
        }
    };

    request.send();
}