function expand(card) {
  card.classList.toggle("large");

  var div = document.getElementById("overlay-bg");
  div.classList.toggle("overlay-bg");
  div.addEventListener("click", function () {
    expand(card);
  });

  var children = card.children;
  for (var i = 1; i < children.length; i++) {
    children[i].classList.toggle("hidden");
  }

  var id = card.id;
  document.getElementById(id + "-expanded").classList.toggle("hidden");
}

function superSearch() {
  window.scrollTo(0, 0);
  var params = document.getElementById("inpt_search").value;
  params = params.trim();

  if (params == "" || params == null) {
    document.getElementById("searchResults").innerHTML = "";
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "/account/superSearch?params=" + params, true);
  xhr.onload = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("searchResults").innerHTML = "";
      if (
        xhr.responseText == null ||
        xhr.responseText == "" ||
        xhr.responseText == "[]"
      ) {
        return;
      }

      var response = JSON.parse(xhr.responseText);
      console.log(response);
      createSearchRows(response);
    }
  };
  xhr.send();
}

function createSearchRows(results) {
  for (var i = 0; i < results.length; i++) {
    var row = HTMLrowTemplate(
      results[i].id,
      results[i].name,
      results[i].mail,
      results[i].tokenNb,
      results[i].isAdmin,
      results[i].isConfirmed,
      results[i].isBanned
    );
    document.getElementById("searchResults").appendChild(row);
  }
}

function HTMLrowTemplate(
  id,
  name,
  mail,
  flags,
  isAdmin,
  isConfirmed,
  isBanned
) {
  const searchRow = document.createElement("div");
  searchRow.classList.add("searchRow");

  const searchID = document.createElement("p");
  searchID.classList.add("searchID");
  searchID.textContent = id;
  searchRow.appendChild(searchID);

  const searchName = document.createElement("p");
  searchName.classList.add("searchName");
  searchName.id = "searchedName-" + id;
  searchName.textContent = name;
  searchRow.appendChild(searchName);

  const searchMail = document.createElement("p");
  searchMail.classList.add("searchMail");
  searchMail.id = "searchedEmail-" + id;
  searchMail.textContent = mail;
  searchRow.appendChild(searchMail);

  const searchFlags = document.createElement("p");
  searchFlags.classList.add("searchFlags");
  searchFlags.textContent = flags;
  searchRow.appendChild(searchFlags);

  const searchActions = document.createElement("div");
  searchActions.classList.add("searchActions");
  searchRow.appendChild(searchActions);

  if (flags > 0) {
    var unflagAction = document.createElement("img");
    unflagAction.src = "/public/svg/account/unflag.svg";
    unflagAction.id = "unflag-" + id;
    unflagAction.title = "Unflag user";
    unflagAction.onclick = function () {
      confirmAction("unflag", id);
    };
    searchActions.appendChild(unflagAction);
  }

  if (isAdmin) {
    return searchRow;
  }

  if (isBanned) {
    var unbanAction = document.createElement("img");
    unbanAction.src = "/public/svg/account/unban.svg";
    unbanAction.id = "unban-" + id;
    unbanAction.title = "Unban user";
    unbanAction.onclick = function () {
      confirmAction("unban", id);
    };
    searchActions.appendChild(unbanAction);
  } else {
    var banAction = document.createElement("img");
    banAction.src = "/public/svg/account/ban.svg";
    banAction.id = "ban-" + id;
    banAction.title = "Ban user";
    banAction.onclick = function () {
      confirmAction("ban", id);
    };
    searchActions.appendChild(banAction);
  }

  var deleteAction = document.createElement("img");
  deleteAction.src = "/public/svg/account/trash.svg";
  deleteAction.id = "delete-" + id;
  deleteAction.title = "Delete user";
  deleteAction.onclick = function () {
    confirmAction("delete", id);
  };
  searchActions.appendChild(deleteAction);

  return searchRow;
}

function toggleSearchExpand() {
  const input = document.getElementById("inpt_search");
  const isFocused = document.activeElement === input;

  const search = document.getElementById("search");
  if (isFocused) {
    search.classList.add("focused");
  } else {
    search.classList.remove("focused");
  }
}

function confirmAction(action, id) {
  var name = document.getElementById("searchedName-" + id).textContent;
  var r = confirm("Are you sure you want to " + action + " this user? " + name);
  if (r == true) {
    processAction(action, id);
  }
}

function processAction(action, id) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/account/userAction?action=" + action + "&id=" + id, true);
  xhr.onload = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == "OK") {
        alert("Action processed successfully");
      } else {
        alert("Action failed: " + xhr.responseText);
      }
    }
  };
  xhr.send();
}
