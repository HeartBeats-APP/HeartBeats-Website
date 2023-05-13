// Générer des valeurs aléatoires pour les graphiques
function generateRandomData(max, min) {
    var data = [];
    for (var i = 0; i < 7; i++) {
      data.push(Math.floor(Math.random() * (max - min + 1)) + min);
    }
    return data;
}

function createChart(chartId, label, data, maxScaleValue, colorCurve) {
    var ctx = document.getElementById(chartId).getContext('2d');
    var chartData = {
      labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
      datasets: [{
        label: label,
        data: data,
        backgroundColor: 'rgba(' + colorCurve + ', 0.5)',
        borderColor: 'rgba(' + colorCurve + ', 1)',
        borderWidth: 4
      }]
    };
    var options = {
      responsive: true,
      scales: {
        y: {
            beginAtZero: true,
            max: maxScaleValue,
            grid: {
                color: 'rgba(255, 255, 255, 0.4)'
            },
            ticks: {
                color: 'rgba(255, 255, 255, 0.8)'
            }
        },
        x: {
            grid: {
                color: 'rgba(255, 255, 255, 0.4)'
            },
            ticks: {
                color: 'rgba(255, 255, 255, 0.8)'
            }
        }
      },
      color: 'white'
    };
    new Chart(ctx, {
      type: 'line',
      data: chartData,
      options: options
    });
}

// Appeler la fonction pour créer les graphiques au chargement de la page
window.addEventListener('load', function() {
    var temperatureData = generateRandomData(45, 20);
    createChart('temperature-chart', 'Température', temperatureData, 50, '255, 99, 132');

    var humidityData = generateRandomData(90, 30);
    createChart('humidity-chart', 'Humidité', humidityData, 100, '54, 162, 235');

    var soundLevelData = generateRandomData(80, 30);
    createChart('sound-level-chart', 'Niveau sonore', soundLevelData, 100, '255, 206, 86');

    var bpmLevelData = generateRandomData(150, 50);
    createChart('bpm-level-chart', 'BPM', bpmLevelData, 200, '75, 192, 192');
});


// Sélectionnez tous les éléments graph
const graphs = document.querySelectorAll('.graph');

// Ajoutez un gestionnaire d'événement survol à chaque élément graph
graphs.forEach(graph => {
  graph.addEventListener('mouseenter', () => {
    // Ajoutez la classe "hover" à l'élément graph survolé
    graph.classList.add('hover');
  });

  graph.addEventListener('mouseleave', () => {
    // Supprimez la classe "hover" de l'élément graph lorsque la souris quitte le graphique
    graph.classList.remove('hover');
  });

  // Ajoutez un gestionnaire d'événement clic à chaque élément graph
  graph.addEventListener('click', () => {
    // Supprimez la classe "clicked" de tous les éléments graph
    graphs.forEach(otherGraph => {
      otherGraph.classList.remove('clicked');
    });

    // Ajoutez la classe "clicked" à l'élément graph cliqué
    graph.classList.add('clicked');

    // Ajoutez ou supprimez la classe "clicked" du conteneur graph-container
    const graphContainer = document.querySelector('.graph-container');
    graphContainer.classList.add('clicked');
  });
});

// Ajoutez un gestionnaire d'événement clic sur le document entier
document.addEventListener('click', event => {
  // Vérifiez si l'élément cliqué est en dehors du graph-container et des graphiques agrandis
  const isOutsideGraphContainer = !event.target.closest('.graph-container');
  const isOutsideGraphs = !event.target.closest('.graph.clicked');

  if (isOutsideGraphContainer && isOutsideGraphs) {
    // Supprimez la classe "clicked" de tous les graphiques et du conteneur graph-container
    graphs.forEach(graph => {
      graph.classList.remove('clicked');
    });

    const graphContainer = document.querySelector('.graph-container');
    graphContainer.classList.remove('clicked');
  }
});