let sended = true;

function sendHeadsetMode() {
  if (sended) {
    sended = !sended;
    return;
  }
  sended = !sended;

  const radios = document.getElementsByName("toggle");
  let headsetMode;

  for (const radio of radios) {
    if (radio.checked) {
      headsetMode = radio.value;
      break;
    }
  }

  //create a new http request
  var xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/account/toggleHeadsetMode?headsetMode=" + headsetMode,
    true
  );
  xhr.onloadend = function () {
    console.log(xhr.responseText);
    if (xhr.status == 200) {
      switch (xhr.responseText) {
        case "1":
          document.getElementById("radio1").checked = true;
          break;
        case "2":
          document.getElementById("radio2").checked = true;
          break;
        case "3":
          document.getElementById("radio3").checked = true;
          break;
        default:
          alert("Error: " + xhr.responseText);
          document.getElementById("radio2").checked = true;
          break;
      }
    }
  };
  xhr.send();
}
