<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appel Vidéo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4">
    <H1 class="text-2xl font-bold text-gray-700 mb-2">Bienvenue dans notre espace de vidéo conférence <img src="{{ asset("assets\communs\logo_avycompta.png") }}" alt="Logo" style="width: 100px; height :100px;"> </H1>

    <p class="text-lg text-gray-600 mb-4">
        Salle : <span id="room-name" class="font-semibold text-blue-600"></span>
    </p>

    <div id="jitsi-container" class="w-full max-w-4xl h-[500px] bg-white shadow-lg rounded-lg overflow-hidden"></div>


    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Récupérer le paramètre "room" depuis l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const roomName = urlParams.get("room") || "SalleParDefaut";

            // Afficher le nom de la salle sur la page
            document.getElementById("room-name").textContent = roomName;

            // Initialiser Jitsi Meet avec le bon nom de salle
            const domain = "meet.jit.si";
            const options = {
                roomName: roomName,
                width: "100%",
                height: "100%",
                parentNode: document.getElementById("jitsi-container"),
            };
            new JitsiMeetExternalAPI(domain, options);
        });
    </script>

</body>
</html>
