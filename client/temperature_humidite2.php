<!DOCTYPE html>
<html>
<head>
    <title>Graphiques de température et d'humidité</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
            color: #555;
            text-shadow: 1px 1px 1px #ccc;
        }
        #chart-container {
            background-color: #fff;
            box-shadow: 0px 0px 8px #ddd;
            width: 80%;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            animation: fadeIn 1s;
        }
        #temperature-chart-container, #humidity-gauge-container {
            width: 45%;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 20px;
        }
        #temperature-chart-container canvas, #humidity-gauge-container canvas {
            width: 100% !important;
        }
        button {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }
        button:hover {
            background-color: #3e8e41;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <h1>Graphiques de température et d'humidité</h1>
    <div id="chart-container">
        <div id="temperature-chart-container">
            <canvas id="temperature-chart"></canvas>
        </div>
        <div id="humidity-gauge-container">
            <canvas id="humidity-gauge"></canvas>
        </div>
        <div style="clear:both;"></div>
    </div>
    <button onclick="location.href='update.php'">Retour à la page de mise à jour</button>
    <script>
        // Récupérer les données de la base de données
        var temperatures = [];
        var humidites = [];
        <?php
        $db = new SQLite3('temperature_humidite.db');
        $query = "SELECT temperature, humidite FROM temperature_humidite ORDER BY id DESC LIMIT 10";
        $result = $db->query($query);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "temperatures.push(" . $row['temperature'] . ");";
            echo "humidites.push(" . $row['humidite'] . ");";
        }
        $db->close();
        ?>

        // Créer le graphique de température
        var temperatureCtx = document.getElementById('temperature-chart').getContext('2d');
        var temperatureChart = new Chart(temperatureCtx, {
            type: 'line',
            data: {
                labels: Array.from({length: 10}, (_, i) => i),
                datasets: [{
                    label: 'Température',
                    data: temperatures,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Créer la jauge d'humidité
        var humidityCtx = document.getElementById('humidity-gauge').getContext('2d');
        var humidityGauge = new Chart(humidityCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [humidites[0], 100 - humidites[0]],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 80,
                tooltips: {
                    enabled: false
                },
                legend: {
                    display: false
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart',
                    onProgress: function(animation) {
                        var hum = humidityGauge.config.data.datasets[0].data[0];
                        var step = animation.currentStep;
                        var maxHum = Math.max(...humidites);
                        var targetHum = humidites[0];
                        var diffHum = targetHum - hum;
                        var newHum = hum + (diffHum / animation.numSteps * step);
                        humidityGauge.config.data.datasets[0].data[0] = newHum;
                        humidityGauge.config.data.datasets[0].backgroundColor[0] = 'rgba(54, 162, 235, ' + (newHum / maxHum) + ')';
                        humidityGauge.update();
                    }
                }
            }
        });
    </script>
</body>
</html>
