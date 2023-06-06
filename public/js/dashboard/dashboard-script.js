let serverConnection = true;
let TemperatureSet = [];
let HumiditySet = [];
let SoundLevelSet = [];
let BpmLevelSet = [];

function createChart(chartId, label, data, maxScaleValue, colorCurve) {
  var ctx = document.getElementById(chartId).getContext("2d");
  var chartData = {
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ,11 ,12 ,13 ,14 ,15],
    datasets: [
      {
        label: label,
        data: data,
        backgroundColor: "rgba(" + colorCurve + ", 0.5)",
        borderColor: "rgba(" + colorCurve + ", 1)",
        borderWidth: 4,
        fill : true,
        fillColor : "rgba(" + colorCurve + ", 0.25)",
      },
    ],
  };
  var options = {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        max: maxScaleValue,
        grid: {
          color: "rgba(255, 255, 255, 0.4)",
        },
        ticks: {
          color: "rgba(255, 255, 255, 0.8)",
        },
      },
      x: {
        grid: {
          color: "rgba(255, 255, 255, 0.4)",
        },
        ticks: {
          color: "rgba(255, 255, 255, 0.8)",
        },
      },
    },
    color: "white",
    tension: 0.5,
  };
  new Chart(ctx, {
    type: "line",
    data: chartData,
    options: options,
  });
}

// Appeler la fonction pour crÃ©er les graphiques au chargement de la page
window.addEventListener("load", function () {
  getData();
  if (TemperatureSet.length < 15) {
    setTimeout(function () {
      createGraphs();
    }, 750);
  }
});

function createGraphs() {
  createChart(
    "temperature-chart",
    "TempÃ©rature",
    TemperatureSet,
    50,
    "255, 99, 132"
  );

  createChart("humidity-chart", "HumiditÃ©", HumiditySet, 100, "54, 162, 235");

  createChart(
    "sound-level-chart",
    "Niveau sonore",
    SoundLevelSet,
    100,
    "255, 206, 86"
  );

  createChart("bpm-level-chart", "BPM", BpmLevelSet, 200, "75, 192, 192");
}

// SÃ©lectionnez tous les Ã©lÃ©ments graph
const graphs = document.querySelectorAll(".graph");

// Ajoutez un gestionnaire d'Ã©vÃ©nement survol Ã  chaque Ã©lÃ©ment graph
graphs.forEach((graph) => {
  graph.addEventListener("mouseenter", () => {
    // Ajoutez la classe "hover" Ã  l'Ã©lÃ©ment graph survolÃ©
    graph.classList.add("hover");
  });

  graph.addEventListener("mouseleave", () => {
    // Supprimez la classe "hover" de l'Ã©lÃ©ment graph lorsque la souris quitte le graphique
    graph.classList.remove("hover");
  });

  // Ajoutez un gestionnaire d'Ã©vÃ©nement clic Ã  chaque Ã©lÃ©ment graph
  graph.addEventListener("click", () => {
    // Supprimez la classe "clicked" de tous les Ã©lÃ©ments graph
    graphs.forEach((otherGraph) => {
      otherGraph.classList.remove("clicked");
    });

    // Ajoutez la classe "clicked" Ã  l'Ã©lÃ©ment graph cliquÃ©
    graph.classList.add("clicked");

    // Ajoutez ou supprimez la classe "clicked" du conteneur graph-container
    const graphContainer = document.querySelector(".graph-container");
    graphContainer.classList.add("clicked");
  });
});

// Ajoutez un gestionnaire d'Ã©vÃ©nement clic sur le document entier
document.addEventListener("click", (event) => {
  // VÃ©rifiez si l'Ã©lÃ©ment cliquÃ© est en dehors du graph-container et des graphiques agrandis
  const isOutsideGraphContainer = !event.target.closest(".graph-container");
  const isOutsideGraphs = !event.target.closest(".graph.clicked");

  if (isOutsideGraphContainer && isOutsideGraphs) {
    // Supprimez la classe "clicked" de tous les graphiques et du conteneur graph-container
    graphs.forEach((graph) => {
      graph.classList.remove("clicked");
    });

    const graphContainer = document.querySelector(".graph-container");
    graphContainer.classList.remove("clicked");
  }
});

async function getSensorsData() {
  var request = new XMLHttpRequest();
  request.open("GET", "dashboard/getData", true);
  return new Promise((resolve, reject) => {
    request.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        answer = JSON.parse(this.responseText);

        if (answer == null || answer == undefined || answer == "") {
          serverConnection = false;
          alert("Error while getting data from the server");
          document.getElementById("graph-container").style.display = "none";
          reject();
        }
        resolve(answer);
      }
    };
    request.send();
  });
}

async function getData() {
  for (let i = 0; i < 15; i++) {
    var data = await getSensorsData();
    TemperatureSet.push(data.temperature);
    HumiditySet.push(data.humidity);
    SoundLevelSet.push(data.soundLevel);
    BpmLevelSet.push(data.bpmLevel);
  }
}

async function updateData() {
  if (!serverConnection) {
    return;
  }

  var data = await getSensorsData();
  TemperatureSet.shift();
  HumiditySet.shift();
  SoundLevelSet.shift();
  BpmLevelSet.shift();
  TemperatureSet.push(data.temperature);
  HumiditySet.push(data.humidity);
  SoundLevelSet.push(data.soundLevel);
  BpmLevelSet.push(data.bpmLevel);
}

setInterval(updateData, 4000);
