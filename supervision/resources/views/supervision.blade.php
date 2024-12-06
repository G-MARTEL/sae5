<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        th {
            cursor: pointer;
        }
        th::after {
            content: '\25B2\25BC';
            font-size: 0.8em;
            margin-left: 5px;
            opacity: 0.5;
        }
        th.sort-asc::after {
            content: '\25B2';
            opacity: 1;
        }
        th.sort-desc::after {
            content: '\25BC';
            opacity: 1;
        }
        .notification-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .notification {
            background-color: #f0f0f0;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .notification.warning {
            background-color: orange;
            color: white;
        }
        .notification.critical {
            background-color: red;
            color: white;
        }
        .notification.show {
            opacity: 1;
        }
        .stats-btn {
            padding: 10px 20px;
            border-radius: 20px;
            border: 2px solid white;
            background-color: #ffffff00;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-left: auto; /* Aligne le bouton à droite */
        }
        .stats-btn:hover {
            background-color: #ffde59;
            color: #248680;
            border: 2px solid #248680;
        }
    </style>
</head>
<body>
    <div class="titre"><h1>Supervision</h1></div>
    <div class="toolbar">
        <input type="text" placeholder="Rechercher..." class="search-bar" id="searchInput">
        <button class="filter-btn"><img src="{{ asset('img/icone/filtre.png') }}" alt="Icone de filtre"></button>
        <button class="status-btn active" id="globalBtn">Etat global</button>
        <button class="status-btn" id="criticalBtn">Etat critique</button>
        <button class="stats-btn" id="statsBtn">Statistique</button>
    </div>
    <table>
        <thead>
            <tr>
                <th data-sort="machine_name">Nom</th>
                <th data-sort="ping">Ping</th>
                <th data-sort="storage">Stockage</th>
                <th data-sort="ram">RAM</th>
                <th data-sort="cpu">CPU</th>
            </tr>
        </thead>
        <tbody id="deviceTableBody">
            <!-- Le corps du tableau sera rempli dynamiquement par AJAX -->
        </tbody>
    </table>
    <div id="notificationContainer" class="notification-container"></div>
    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}"></audio>
    <script>
        let allDevices = [];
        let filteredDevices = [];
        let currentSort = { column: null, direction: 'asc' };

        function showNotification(message, type) {
            const notificationContainer = document.getElementById('notificationContainer');
            const notification = document.createElement('div');
            notification.classList.add('notification', type);
            notification.textContent = message;
            notificationContainer.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);

            document.getElementById('notificationSound').play();

            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notificationContainer.removeChild(notification);
                }, 300);
            }, 30000);
        }

        function checkDeviceNotifications(devices) {
            devices.forEach(device => {
                const storagePercentage = (device.storage / device.max_storage) * 100;
                if (!device.ping) {
                    showNotification(`${device.machine_name}: Ping échoué`, 'critical');
                }
                if (storagePercentage >= 90) {
                    showNotification(`${device.machine_name}: Stockage critique (${storagePercentage.toFixed(1)}%)`, 'critical');
                } else if (storagePercentage >= 85) {
                    showNotification(`${device.machine_name}: Avertissement stockage (${storagePercentage.toFixed(1)}%)`, 'warning');
                }
                if (device.ram >= 90) {
                    showNotification(`${device.machine_name}: Utilisation RAM critique (${device.ram}%)`, 'critical');
                } else if (device.ram >= 80) {
                    showNotification(`${device.machine_name}: Avertissement utilisation RAM (${device.ram}%)`, 'warning');
                }
                if (device.cpu >= 90) {
                    showNotification(`${device.machine_name}: Utilisation CPU critique (${device.cpu}%)`, 'critical');
                } else if (device.cpu >= 80) {
                    showNotification(`${device.machine_name}: Avertissement utilisation CPU (${device.cpu}%)`, 'warning');
                }
            });
        }

        function fetchDevices() {
            fetch('{{ route("getDevices") }}')
                .then(response => response.json())
                .then(data => {
                    allDevices = data;
                    checkDeviceNotifications(data);
                    filterAndSortDevices();
                })
                .catch(error => console.error("Erreur lors de la récupération des données :", error));
        }

        function updateTable(devices) {
            const tableBody = document.querySelector("#deviceTableBody");
            tableBody.innerHTML = "";
            devices.forEach(device => {
                const storagePercentage = (device.storage / device.max_storage) * 100;
                const pingClass = device.ping ? "status-ok" : "status-error";
                const storageClass = storagePercentage >= 90 ? "status-error" : (storagePercentage >= 85 ? "status-warning" : "");
                const ramClass = device.ram >= 90 ? "status-error" : (device.ram >= 80 ? "status-warning" : "");
                const cpuClass = device.cpu >= 90 ? "status-error" : (device.cpu >= 80 ? "status-warning" : "");
                
                tableBody.innerHTML += `
                    <tr>
                        <td class="titleTableau">${device.machine_name}</td>
                        <td class="${pingClass}">${device.ping ? "oui" : "non"}</td>
                        <td class="${storageClass}">${device.storage}/${device.max_storage}Go</td>
                        <td class="${ramClass}">${device.ram}%</td>
                        <td class="${cpuClass}">${device.cpu}%</td>
                    </tr>
                `;
            });
        }

        function filterAndSortDevices() {
            const query = document.getElementById("searchInput").value.toLowerCase();
            const activeStatus = document.querySelector(".status-btn.active").id;
            
            let filteredByName = allDevices.filter(device => device.machine_name.toLowerCase().includes(query));
            
            if (activeStatus === "globalBtn") {
                filteredDevices = filteredByName;
            } else if (activeStatus === "criticalBtn") {
                filteredDevices = filteredByName.filter(device => {
                    const storagePercentage = (device.storage / device.max_storage) * 100;
                    return !device.ping || storagePercentage >= 80 || device.ram >= 90 || device.cpu >= 90;
                });
            }
            
            if (currentSort.column) {
                filteredDevices.sort((a, b) => {
                    let valueA, valueB;
                    switch (currentSort.column) {
                        case 'machine_name':
                            valueA = a.machine_name.toLowerCase();
                            valueB = b.machine_name.toLowerCase();
                            break;
                        case 'ping':
                            valueA = a.ping ? 1 : 0;
                            valueB = b.ping ? 1 : 0;
                            break;
                        case 'storage':
                            valueA = a.storage / a.max_storage;
                            valueB = b.storage / b.max_storage;
                            break;
                        case 'ram':
                            valueA = a.ram;
                            valueB = b.ram;
                            break;
                        case 'cpu':
                            valueA = a.cpu;
                            valueB = b.cpu;
                            break;
                    }
                    if (valueA < valueB) return currentSort.direction === 'asc' ? -1 : 1;
                    if (valueA > valueB) return currentSort.direction === 'asc' ? 1 : -1;
                    return 0;
                });
            }
            
            updateTable(filteredDevices);
        }

        document.getElementById("searchInput").addEventListener("input", filterAndSortDevices);

        document.getElementById("globalBtn").addEventListener("click", () => {
            document.querySelector(".status-btn.active").classList.remove("active");
            document.getElementById("globalBtn").classList.add("active");
            filterAndSortDevices();
        });

        document.getElementById("criticalBtn").addEventListener("click", () => {
            document.querySelector(".status-btn.active").classList.remove("active");
            document.getElementById("criticalBtn").classList.add("active");
            filterAndSortDevices();
        });

        document.querySelectorAll("th").forEach(header => {
            header.addEventListener("click", () => {
                const column = header.dataset.sort;
                if (currentSort.column === column) {
                    currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort.column = column;
                    currentSort.direction = 'asc';
                }
                document.querySelectorAll("th").forEach(th => th.classList.remove("sort-asc", "sort-desc"));
                header.classList.add(currentSort.direction === 'asc' ? "sort-asc" : "sort-desc");
                filterAndSortDevices();
            });
        });

        // Bouton statistique - Redirection
        document.getElementById("statsBtn").addEventListener("click", () => {
            window.location.href = "http://localhost:9090/graphique";
        });

        fetchDevices();
    </script>
</body>
</html>
