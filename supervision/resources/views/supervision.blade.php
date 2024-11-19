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
    </style>
</head>

<body>
    <div class="titre"><h1>Supervision</h1></div>
    
    <div class="toolbar">
        <input type="text" placeholder="Rechercher..." class="search-bar" id="searchInput">
        <button class="filter-btn"><img src="{{ asset('img/icone/filtre.png') }}" alt="Icone de filtre"></button>
        <button class="status-btn active" id="globalBtn">Etat global</button>
        <button class="status-btn" id="criticalBtn">Etat critique</button>
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

    <script>
        let allDevices = []; // Stocker toutes les données des appareils
        let filteredDevices = []; // Stocker les appareils filtrés (basé sur la recherche et l'état)
        let currentSort = { column: null, direction: 'asc' }; // Garder une trace du tri actuel

        // Fonction pour récupérer et afficher les données des appareils
        function fetchDevices() {
            fetch('{{ route("getDevices") }}')
                .then(response => response.json())
                .then(data => {
                    allDevices = data; // Sauvegarder toutes les données
                    filterAndSortDevices();  // Appliquer les filtres et le tri
                })
                .catch(error => console.error("Erreur lors de la récupération des données :", error));
        }

        // Fonction pour afficher les appareils dans le tableau
        function updateTable(devices) {
            const tableBody = document.querySelector("#deviceTableBody");
            tableBody.innerHTML = ""; // Effacer les lignes existantes

            devices.forEach(device => {
                const storagePercentage = (device.storage / device.max_storage) * 100;

                // Définir les classes pour chaque statut
                const pingClass = device.ping ? "status-ok" : "status-error";
                const storageClass = storagePercentage >= 95 ? "status-error" :
                                     (storagePercentage >= 80 ? "status-warning" : "");
                const ramClass = device.ram >= 100 ? "status-error" :
                                 (device.ram >= 90 ? "status-warning" : "");
                const cpuClass = device.cpu >= 100 ? "status-error" :
                                 (device.cpu >= 90 ? "status-warning" : "");

                // Ajouter la ligne du tableau pour chaque appareil
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

        // Fonction pour filtrer et trier les appareils
        function filterAndSortDevices() {
            const query = document.getElementById("searchInput").value.toLowerCase();
            const activeStatus = document.querySelector(".status-btn.active").id;
            
            // Filtrage par nom
            let filteredByName = allDevices.filter(device => device.machine_name.toLowerCase().includes(query));

            if (activeStatus === "globalBtn") {
                filteredDevices = filteredByName;
            } else if (activeStatus === "criticalBtn") {
                filteredDevices = filteredByName.filter(device => {
                    const storagePercentage = (device.storage / device.max_storage) * 100;
                    return !device.ping || storagePercentage >= 80 || device.ram >= 90 || device.cpu >= 90;
                });
            }

            // Appliquer le tri
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

        // Écouter les changements dans la zone de recherche
        document.getElementById("searchInput").addEventListener("input", filterAndSortDevices);

        // Gérer le clic sur les boutons pour l'état global et critique
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

        // Gérer le tri des colonnes
        document.querySelectorAll('th[data-sort]').forEach(th => {
            th.addEventListener('click', () => {
                const column = th.dataset.sort;
                if (currentSort.column === column) {
                    currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort.column = column;
                    currentSort.direction = 'asc';
                }
                
                // Mettre à jour les classes de tri sur les en-têtes
                document.querySelectorAll('th').forEach(header => {
                    header.classList.remove('sort-asc', 'sort-desc');
                });
                th.classList.add(`sort-${currentSort.direction}`);

                filterAndSortDevices();
            });
        });

        // Appeler la fonction fetchDevices toutes les 5 secondes pour actualiser les données
        setInterval(fetchDevices, 5000);

        // Initialiser l'affichage dès le chargement de la page
        fetchDevices();
    </script>
</body>
</html>