<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision des Machines</title>
    <link rel="stylesheet" href="{{ asset('css/graphique.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .chart-container {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .chart-container canvas {
            width: 100%;
            height: 300px;
        }
        #commembers-chart-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .commembers-chart-container {
            text-align: center;
            width: 23%;
        }
        .commembers-chart-container canvas {
            width: 100%;
            height: 200px;
            margin: 0 auto;
        }
        .chart-title {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <a href="{{ url('/') }}" class="back-to-home-btn">Retour à la supervision</a>
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
        <div class="main-content">
            <h1>Supervision de la machine : {{ $machineName }}</h1>
            <div id="charts-container" class="charts-grid">
                <div class="chart-container">
                    <canvas id="pingChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="cpuChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="storageChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="ramChart"></canvas>
                </div>
            </div>
            <h2 class="chart-title">Pourcentage selon l'état des ressources</h2>
            <div id="commembers-chart-container">
                <div class="commembers-chart-container">
                    <h3>État Ping</h3>
                    <canvas id="pingCommembersChart"></canvas>
                </div>
                <div class="commembers-chart-container">
                    <h3>État CPU</h3>
                    <canvas id="cpuCommembersChart"></canvas>
                </div>
                <div class="commembers-chart-container">
                    <h3>État Stockage</h3>
                    <canvas id="storageCommembersChart"></canvas>
                </div>
                <div class="commembers-chart-container">
                    <h3>État RAM</h3>
                    <canvas id="ramCommembersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentMachineId = "{{ $currentMachineId }}";
        const apiUrl = "{{ route('api.get_machine_data') }}";

        const calculateCommembers = (data, type) => {
            let normal = 0, warning = 0, alert = 0;
            const total = data.length;
            data.forEach(value => {
                if (type === 'ping') {
                    if (value === 1) normal++;
                    else alert++;
                } else if (type === 'cpu' || type === 'ram') {
                    if (value >= 90) alert++;
                    else if (value >= 80) warning++;
                    else normal++;
                } else if (type === 'storage') {
                    if (value >= 90) alert++;
                    else if (value >= 85) warning++;
                    else normal++;
                }
            });
            return {
                normal: (normal / total) * 100,
                warning: (warning / total) * 100,
                alert: (alert / total) * 100
            };
        };

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

            const pingState = calculateCommembers(pingData, 'ping');
            pingCommembersChart.data.datasets[0].data = [pingState.normal, pingState.alert];
            pingCommembersChart.update();

            const cpuState = calculateCommembers(cpuData, 'cpu');
            cpuCommembersChart.data.datasets[0].data = [cpuState.normal, cpuState.warning, cpuState.alert];
            cpuCommembersChart.update();

            const ramState = calculateCommembers(ramData, 'ram');
            ramCommembersChart.data.datasets[0].data = [ramState.normal, ramState.warning, ramState.alert];
            ramCommembersChart.update();

            const storageState = calculateCommembers(storageData, 'storage');
            storageCommembersChart.data.datasets[0].data = [storageState.normal, storageState.warning, storageState.alert];
            storageCommembersChart.update();
        };

        fetch(`${apiUrl}?machine_id=${currentMachineId}`)
            .then(response => response.json())
            .then(data => {
                updateCharts(data.labels, data.cpuData, data.ramData, data.storageData, data.pingData);
            })
            .catch(error => console.error("Erreur lors de la récupération des données : ", error));

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
                        min: 0,
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
                            stepSize: 1
                        }
                    }
                }
            }
        });

        const ctxPingCommembers = document.getElementById('pingCommembersChart').getContext('2d');
        const pingCommembersChart = new Chart(ctxPingCommembers, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Alerte'],
                datasets: [{
                    label: 'État Ping (%)',
                    backgroundColor: ['#4CAF50', '#F44336'],
                    data: [0, 100]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false
                    }
                }
            }
        });

        const ctxCpuCommembers = document.getElementById('cpuCommembersChart').getContext('2d');
        const cpuCommembersChart = new Chart(ctxCpuCommembers, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Warning', 'Alerte'],
                datasets: [{
                    label: 'État CPU (%)',
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
                    data: [0, 0, 100]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false
                    }
                }
            }
        });

        const ctxRamCommembers = document.getElementById('ramCommembersChart').getContext('2d');
        const ramCommembersChart = new Chart(ctxRamCommembers, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Warning', 'Alerte'],
                datasets: [{
                    label: 'État RAM (%)',
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
                    data: [0, 0, 100]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false
                    }
                }
            }
        });

        const ctxStorageCommembers = document.getElementById('storageCommembersChart').getContext('2d');
        const storageCommembersChart = new Chart(ctxStorageCommembers, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Warning', 'Alerte'],
                datasets: [{
                    label: 'État Stockage (%)',
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
                    data: [0, 0, 100]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html>