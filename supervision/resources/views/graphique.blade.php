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
        let currentMachineId = "{{ $machineId }}";  // ID de la machine depuis le contrôleur
        const apiUrl = "{{ route('api.get_machine_data') }}"; // API pour récupérer les données

        // Fonction pour mettre à jour les graphiques
        const updateCharts = (labels, cpuData, ramData, storageData, pingData) => {
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
                updateCharts(data.labels, data.cpuData, data.ramData, data.storageData, data.pingData);
            })
            .catch(error => console.error('Erreur:', error));

        // Initialisation des graphiques avec Chart.js
        const ctxCpu = document.getElementById('cpuChart').getContext('2d');
        const cpuChart = new Chart(ctxCpu, {
            type: 'line',
            data: { 
                labels: {!! json_encode($labels) !!}, 
                datasets: [{ 
                    label: 'CPU (%)', 
                    data: {!! json_encode($cpuData) !!}, 
                    borderColor: 'red', 
                    tension: 0.1 
                }] 
            },
            options: { 
                responsive: true, 
                plugins: { title: { display: true, text: 'Utilisation CPU' } } 
            }
        });

        const ctxRam = document.getElementById('ramChart').getContext('2d');
        const ramChart = new Chart(ctxRam, {
            type: 'line',
            data: { 
                labels: {!! json_encode($labels) !!}, 
                datasets: [{ 
                    label: 'RAM (%)', 
                    data: {!! json_encode($ramData) !!}, 
                    borderColor: 'blue', 
                    tension: 0.1 
                }] 
            },
            options: { 
                responsive: true, 
                plugins: { title: { display: true, text: 'Utilisation RAM' } } 
            }
        });

        const ctxStorage = document.getElementById('storageChart').getContext('2d');
        const storageChart = new Chart(ctxStorage, {
            type: 'line',
            data: { 
                labels: {!! json_encode($labels) !!}, 
                datasets: [{ 
                    label: 'Stockage (Go)', 
                    data: {!! json_encode($storageData) !!}, 
                    borderColor: 'green', 
                    tension: 0.1 
                }] 
            },
            options: { 
                responsive: true, 
                plugins: { title: { display: true, text: 'Utilisation Stockage' } } 
            }
        });

        const ctxPing = document.getElementById('pingChart').getContext('2d');
        const pingChart = new Chart(ctxPing, {
            type: 'line',
            data: { 
                labels: {!! json_encode($labels) !!}, 
                datasets: [{ 
                    label: 'Ping (ms)', 
                    data: {!! json_encode($pingData) !!}, 
                    borderColor: 'purple', 
                    tension: 0.1 
                }] 
            },
            options: { 
                responsive: true, 
                plugins: { title: { display: true, text: 'Temps de Réponse (Ping)' } } 
            }
        });
    </script>
</body>
</html>
