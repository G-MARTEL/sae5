<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <th>Nom</th>
                <th>Ping</th>
                <th>Stockage</th>
                <th>RAM</th>
                <th>CPU</th>
            </tr>
        </thead>
        <tbody id="deviceTableBody">
            <!-- Le corps du tableau sera rempli dynamiquement par AJAX -->
        </tbody>
    </table>

    <script>
        let allDevices = []; // Stocker toutes les données des appareils
        let filteredDevices = []; // Stocker les appareils filtrés (basé sur la recherche et l'état)

        // Fonction pour récupérer et afficher les données des appareils
        function fetchDevices() {
            fetch('{{ route("getDevices") }}')
                .then(response => response.json())
                .then(data => {
                    allDevices = data; // Sauvegarder toutes les données
                    filterDevices();  // Appliquer les filtres (recherche et état)
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

        // Fonction pour filtrer les appareils par nom et par état
        function filterDevices() {
            const query = document.getElementById("searchInput").value.toLowerCase();
            const activeStatus = document.querySelector(".status-btn.active").id;
            
            // Filtrage par nom
            let filteredByName = allDevices.filter(device => device.machine_name.toLowerCase().includes(query));

            if (activeStatus === "globalBtn") {
                // Si on est en état global, on affiche tous les appareils filtrés par nom
                filteredDevices = filteredByName;
            } else if (activeStatus === "criticalBtn") {
                // Si on est en état critique, on filtre uniquement les appareils ayant des erreurs ou des avertissements
                filteredDevices = filteredByName.filter(device => {
                    const storagePercentage = (device.storage / device.max_storage) * 100;
                    return !device.ping || // Ping en erreur
                           storagePercentage >= 80 || // Stockage en warning ou erreur
                           device.ram >= 90 || // RAM en warning ou erreur
                           device.cpu >= 90; // CPU en warning ou erreur
                });

                // Appliquer les règles de tri en état critique
                filteredDevices.sort((a, b) => {
                    // Prioriser les machines avec un ping en "non"
                    if (!a.ping && b.ping) return -1;
                    if (a.ping && !b.ping) return 1;

                    // Calculer le nombre d'erreurs et de warnings pour chaque appareil
                    const aErrorCount = (!a.ping ? 1 : 0) + 
                                        ((a.storage / a.max_storage) * 100 >= 95 ? 1 : 0) + 
                                        (a.ram >= 100 ? 1 : 0) + 
                                        (a.cpu >= 100 ? 1 : 0);
                    const bErrorCount = (!b.ping ? 1 : 0) + 
                                        ((b.storage / b.max_storage) * 100 >= 95 ? 1 : 0) + 
                                        (b.ram >= 100 ? 1 : 0) + 
                                        (b.cpu >= 100 ? 1 : 0);

                    const aWarningCount = ((a.storage / a.max_storage) * 100 >= 80 && (a.storage / a.max_storage) * 100 < 95 ? 1 : 0) + 
                                          (a.ram >= 90 && a.ram < 100 ? 1 : 0) + 
                                          (a.cpu >= 90 && a.cpu < 100 ? 1 : 0);
                    const bWarningCount = ((b.storage / b.max_storage) * 100 >= 80 && (b.storage / b.max_storage) * 100 < 95 ? 1 : 0) + 
                                          (b.ram >= 90 && b.ram < 100 ? 1 : 0) + 
                                          (b.cpu >= 90 && b.cpu < 100 ? 1 : 0);

                    // Trier d'abord par nombre d'erreurs, puis par nombre de warnings
                    if (aErrorCount !== bErrorCount) return bErrorCount - aErrorCount;
                    if (aWarningCount !== bWarningCount) return bWarningCount - aWarningCount;

                    return 0; // Si tout est égal, maintenir l'ordre
                });
            }

            // Mettre à jour le tableau avec les appareils filtrés
            updateTable(filteredDevices);
        }

        // Écouter les changements dans la zone de recherche
        document.getElementById("searchInput").addEventListener("input", filterDevices);

        // Gérer le clic sur les boutons pour l'état global et critique
        document.getElementById("globalBtn").addEventListener("click", () => {
            document.querySelector(".status-btn.active").classList.remove("active");
            document.getElementById("globalBtn").classList.add("active");
            filterDevices();
        });

        document.getElementById("criticalBtn").addEventListener("click", () => {
            document.querySelector(".status-btn.active").classList.remove("active");
            document.getElementById("criticalBtn").classList.add("active");
            filterDevices();
        });

        // Appeler la fonction fetchDevices toutes les 2 secondes pour actualiser les données
        setInterval(fetchDevices, 2000);

        // Initialiser l'affichage dès le chargement de la page
        fetchDevices();
    </script>
</body>
</html>