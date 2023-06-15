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

  var xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/account/toggleHeadsetMode?headsetMode=" + headsetMode,
    true
  );
  xhr.onloadend = function () {
    if (xhr.status == 200) {
      switch (xhr.responseText) {
        case "1":
          document.getElementById("radio1").checked = true;
          logSuccess("Command successfully sent");
          break;
        case "2":
          document.getElementById("radio2").checked = true;
          logSuccess("Command successfully sent");
          break;
        case "3":
          document.getElementById("radio3").checked = true;
          logSuccess("Command successfully sent");
          break;
        default:
          logError(xhr.responseText);
          document.getElementById("radio2").checked = true;
          break;
      }
    }
  };
  xhr.send();
}

function refreshData() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/account/refreshData", true);
  xhr.onloadend = function () {
    if (xhr.status == 200) {
      if (xhr.responseText == "OK") {
        logSuccess("Data successfully refreshed");
      } else {
        logError(xhr.responseText);
      }
    } else {
      logError(xhr.responseText);
    }
  };
  xhr.send();
}

function logSuccess(message) {
  console.log("%c ✅" + message, "background: #ebffe8; color: green");
}

function logError(message) {
  console.log("%c ❌" + message, "background: #ffe8e8; color: red");
}
