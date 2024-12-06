<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision des Machines</title>
    <!-- Inclure une bibliothèque CSS -->
    <link rel="stylesheet" href="{{ asset('css/graphique.css') }}">
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Barre latérale gauche -->
        <div class="sidebar">
            <h2>Machines</h2>
            <ul>
                @foreach ($machines as $machine)
                    <li>
                        <a href="{{ url('/graphique/' . $machine->machine_id) }}" class="machine-link">
                            {{ $machine->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="main-content">
            <h1>Supervision des Machines</h1>
            <div id="charts-container">
                <!-- Graphique CPU -->
                <div class="chart-container">
                    <canvas id="cpuChart"></canvas>
                </div>

                <!-- Graphique RAM -->
                <div class="chart-container">
                    <canvas id="ramChart"></canvas>
                </div>

                <!-- Graphique Stockage -->
                <div class="chart-container">
                    <canvas id="storageChart"></canvas>
                </div>

                <!-- Graphique Ping -->
                <div class="chart-container">
                    <canvas id="pingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialisation des données globales
        let currentMachineId = "{{ $currentMachineId }}";  // ID de la machine depuis le contrôleur
        const apiUrl = "{{ route('api.get_machine_data') }}"; // API pour récupérer les données

        // Fonction pour mettre à jour les graphiques
        const updateCharts = (labels, cpuData, ramData, storageData, pingData, maxStorage) => {
            // Mise à jour des graphiques
            cpuChart.data.labels = labels;
            cpuChart.data.datasets[0].data = cpuData;
            cpuChart.update();

            ramChart.data.labels = labels;
            ramChart.data.datasets[0].data = ramData;
            ramChart.update();

            storageChart.data.labels = labels;
            storageChart.data.datasets[0].data = storageData;
            storageChart.update();

            pingChart.data.labels = labels;
            pingChart.data.datasets[0].data = pingData;
            pingChart.update();
        };

        // Appel AJAX pour récupérer les données initiales de la machine
        fetch(`${apiUrl}?machine_id=${currentMachineId}`)
            .then(response => response.json())
            .then(data => {
                updateCharts(data.labels, data.cpuData, data.ramData, data.storageData, data.pingData, {{ $maxStorage }});
            })
            .catch(error => console.error("Erreur lors de la récupération des données : ", error));

        // Configuration des graphiques
        const ctxCpu = document.getElementById('cpuChart').getContext('2d');
        const cpuChart = new Chart(ctxCpu, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'CPU Usage (%)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    data: []
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        title: {
                            display: true,
                            text: "CPU Usage"
                        }
                    }
                }
            }
        });

        const ctxRam = document.getElementById('ramChart').getContext('2d');
        const ramChart = new Chart(ctxRam, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'RAM Usage (%)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    fill: false,
                    data: []
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        title: {
                            display: true,
                            text: "RAM Usage"
                        }
                    }
                }
            }
        });

        const ctxStorage = document.getElementById('storageChart').getContext('2d');
        const storageChart = new Chart(ctxStorage, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'Storage Usage (GB)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    fill: false,
                    data: []
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0, // Défini le minimum de stockage à 0
                        title: {
                            display: true,
                            text: "Storage (GB)"
                        }
                    }
                }
            }
        });

        const ctxPing = document.getElementById('pingChart').getContext('2d');
        const pingChart = new Chart(ctxPing, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'Ping (0 or 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false,
                    data: []
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 1,
                        title: {
                            display: true,
                            text: "Ping (0 or 1)"
                        },
                        ticks: {
                            stepSize: 1 // Afficher uniquement 0 et 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
