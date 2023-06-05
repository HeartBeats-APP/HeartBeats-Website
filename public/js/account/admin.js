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
    var row = HTMLrowTemplate(results[i].id, results[i].name, results[i].mail);
    document.getElementById("searchResults").appendChild(row);
  }
}

function HTMLrowTemplate(id, name, mail) {
  const searchRow = document.createElement("div");
  searchRow.classList.add("searchRow");

  const searchID = document.createElement("p");
  searchID.classList.add("searchID");
  searchID.textContent = id;
  searchRow.appendChild(searchID);

  const searchName = document.createElement("p");
  searchName.classList.add("searchName");
  searchName.textContent = name;
  searchRow.appendChild(searchName);

  const searchMail = document.createElement("p");
  searchMail.classList.add("searchMail");
  searchMail.textContent = mail;
  searchRow.appendChild(searchMail);

  const searchActions = document.createElement("div");
  searchActions.classList.add("searchActions");
  searchRow.appendChild(searchActions);

  return searchRow;
}

function toggleSearchExpand() {
  const input = document.getElementById("inpt_search");
  const isFocused = document.activeElement === input;

  const search = document.getElementById("search")
  if (isFocused) {
    search.classList.add("focused");
  } else {
    search.classList.remove("focused");
  }
}

