@extends('layouts.notification')
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Employé</title>
    <link rel="stylesheet" href="{{ asset('css/admin/AdminAccueil.css') }}">
    <link rel="stylesheet" href="{{ asset('css\employee\notifications.css') }}">
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

</head>



<body>
    <a href="{{ route('logout') }}"><button class="logout-btn">Déconnexion</button></a>

    <div class="container">
        <div class="container-inner">
            <strong>Bienvenue sur votre espace personnel</strong>
        </div>
    </div>

    <div class="container">
        <div class="container-inner">
            <h2>Messagerie</h2>
            <a href="conversation">Accéder à votre messagerie</a>
        </div>
    
        <div class="container-inner">
            <h2>Gestion des clients</h2>
            <a href="listeClientAttitres">Accéder à la liste de vos clients</a>
        </div>

        <div class="container-inner">
            <h2>Appel vidéo</h2>
            <a href="{{ route('video-call', ['room' => uniqid()]) }}" class="btn btn-primary">
                Démarrer un appel vidéo
            </a>
        </div>

        <div class="container-inner">
            <h2>Gestion des devis</h2>
            <a href="listeDemandesDevis">
                Accéder aux demandes de devis
            </a>
        </div>


    </div>
    
    {{-- <div id="notificationArea">
        <h3>Notifications</h3>
        <p>Votre ID : <span id="employeeIdDisplay"></span></p>
        <ul id="notificationsContainer">
            <li>Chargement...</li>
        </ul>
    </div>
     --}}

</body>
{{-- 
<script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetchNotifications() {
                fetch("{{ route('employees.notifications.get') }}")
                    .then(response => response.json())
                    .then(data => {
                        const notifContainer = document.getElementById("notificationsContainer");
                        notifContainer.innerHTML = "";
        
                        if (data.length > 0) {
                            data.forEach(notif => {
                                let notifElement = document.createElement("li");
                                notifElement.textContent = `${notif.content} (${notif.date})`;
        
                                // Création du bouton "Vu"
                                let seenButton = document.createElement("button");
                                seenButton.textContent = "Vu";
                                seenButton.classList.add("mark-as-seen");
                                seenButton.dataset.id = notif.notification_id; // Ajouter l'ID de notification au bouton
        
                                // Ajouter un écouteur d'événement pour marquer comme vu
                                seenButton.addEventListener("click", function () {
                                    markAsSeen(notif.notification_id, notifElement);
                                });
        
                                notifElement.appendChild(seenButton); // Ajouter le bouton au li
                                notifContainer.appendChild(notifElement);
                            });
                        } else {
                            notifContainer.innerHTML = "<li>Aucune notification</li>";
                        }
                    })
                    .catch(error => console.error("Erreur lors de la récupération des notifications :", error));
            }
        
            function markAsSeen(notificationId, notifElement) {
                fetch(`/employees/notifications/${notificationId}/markAsSeen`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ seen: true })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    notifElement.style.textDecoration = "line-through"; // Optionnel : barrer la notification vue
                })
                .catch(error => console.error("Erreur lors de la mise à jour de la notification :", error));
            }
        
            fetchNotifications();
            setInterval(fetchNotifications, 5000); // Rafraîchir toutes les 5 secondes
        });
        

        </script>
         --}}