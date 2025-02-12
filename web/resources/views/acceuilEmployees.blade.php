<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Employé</title>
    <link rel="stylesheet" href="{{ asset('css/admin/AdminAccueil.css') }}">
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
            <a href="{{ route('video-call', ['room' => uniqid()]) }}" class="btn btn-primary">
                Démarrer un appel vidéo
            </a>
        </div>


    </div>
    
    <div id="notificationArea">
        <h3>Notifications</h3>
        <p>Votre ID : <span id="employeeIdDisplay"></span></p>
        <ul id="notificationsContainer">
            <li>Chargement...</li>
        </ul>
    </div>
    

</body>
 {{-- <script>
    const currentUserId = {{ session('id') }};
    console.log(currentUserId);
 </script> --}}

{{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const employeeId = "{{ session('id') }}"; // Récupère l'id depuis la session

    if (!employeeId) {
        console.error("Aucun ID d'employé trouvé dans la session.");
        return;
    }

    function fetchNotifications() {
        fetch("/employees/notifications")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Accès interdit");
                }
                return response.json();
            })
            .then(data => {
                const notifContainer = document.getElementById("notificationsContainer");
                notifContainer.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(notif => {
                        let notifElement = document.createElement("li");
                        notifElement.textContent = `${notif.content} (${notif.date})`;
                        notifContainer.appendChild(notifElement);
                    });
                } else {
                    notifContainer.innerHTML = "<li>Aucune notification</li>";
                }
            })
            .catch(error => console.error("Erreur lors de la récupération des notifications :", error));
    }

    fetchNotifications(); // Appel initial pour récupérer les notifications
});

    </script> --}}
    
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
                                notifContainer.appendChild(notifElement);
                            });
                        } else {
                            notifContainer.innerHTML = "<li>Aucune notification</li>";
                        }
                    })
                    .catch(error => console.error("Erreur lors de la récupération des notifications :", error));
            }
        
            fetchNotifications();
            setInterval(fetchNotifications, 5000); // Rafraîchir toutes les 5 secondes
        });
        </script>
        