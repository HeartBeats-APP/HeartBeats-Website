let serverConnection = true;
let TemperatureSet = [];
let HumiditySet = [];
let SoundLevelSet = [];
let BpmLevelSet = [];

function createChart(chartId, label, data, maxScaleValue, colorCurve) {
  var ctx = document.getElementById(chartId).getContext("2d");
  var chartData = {
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
    datasets: [
      {
        label: label,
        data: data,
        backgroundColor: "rgba(" + colorCurve + ", 0.5)",
        borderColor: "rgba(" + colorCurve + ", 1)",
        borderWidth: 4,
        fill: true,
        fillColor: "rgba(" + colorCurve + ", 0.25)",
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

function createGraphs() {
  var graphContainers = document.querySelectorAll(".graph-container");
  graphContainers.forEach(function (container) {
    container.innerHTML = "";
  });

  createChart(
    "temperature-chart",
    "Température",
    TemperatureSet,
    50,
    "255, 99, 132"
  );

  createChart("humidity-chart", "Humidité", HumiditySet, 100, "54, 162, 235");

  createChart(
    "sound-level-chart",
    "Niveau sonore",
    SoundLevelSet,
    100,
    "255, 206, 86"
  );

  createChart("bpm-level-chart", "BPM", BpmLevelSet, 200, "75, 192, 192");
}

window.addEventListener("load", function () {
  getData();
  if (TemperatureSet.length < 15) {
    setTimeout(function () {
      createGraphs();
    }, 750);
  }
});

window.addEventListener("resize", function () {
  createGraphs();
});

const graphs = document.querySelectorAll(".graph");

graphs.forEach((graph) => {
  graph.addEventListener("mouseenter", () => {
    graph.classList.add("hover");
  });

  graph.addEventListener("mouseleave", () => {
    graph.classList.remove("hover");
  });

  graph.addEventListener("click", () => {
    graphs.forEach((otherGraph) => {
      otherGraph.classList.remove("clicked");
    });

    graph.classList.add("clicked");

    const graphContainer = document.querySelector(".graph-container");
    graphContainer.classList.add("clicked");
  });
});

document.addEventListener("click", (event) => {
  const isOutsideGraphContainer = !event.target.closest(".graph-container");
  const isOutsideGraphs = !event.target.closest(".graph.clicked");

  if (isOutsideGraphContainer && isOutsideGraphs) {
    graphs.forEach((graph) => {
      graph.classList.remove("clicked");
    });

    const graphContainer = document.querySelector(".graph-container");
    graphContainer.classList.remove("clicked");
  }
});

setInterval(updateData, 4000);
