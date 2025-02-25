<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéo Conférence - Cabinet d'Expertise Comptable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
    <style>
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a73e8;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-link:hover {
            background-color: #135abc;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
    <header class="w-full max-w-5xl bg-white shadow-md rounded-lg p-6 flex items-center justify-between">
        <img src="{{ asset('assets/communs/logo_avycompta.png') }}" alt="Logo" class="h-16">
        <h1 class="text-3xl font-bold text-gray-800">Espace de Vidéo Conférence</h1>
    </header>

    <main class="w-full max-w-5xl mt-6 bg-white shadow-lg rounded-lg p-6">
        <div id="jitsi-container" class="w-full h-[500px] bg-gray-300 rounded-md overflow-hidden flex items-center justify-center">
        </div>
    </main>

    <a href="{{ route('accueil') }}" class="back-link mt-6" style="background-color: #2c7d7b;">Retour à l'accueil</a>

    <footer class="mt-6 text-center text-gray-600 text-sm">
        &copy; 2025 Cabinet AVYCOMPTA - Tous droits réservés.
    </footer>

    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const domain = "meet.jit.si";
            const options = {
                roomName: "ConferenceRoom",
                width: "100%",
                height: "100%",
                parentNode: document.getElementById("jitsi-container"),
            };
            new JitsiMeetExternalAPI(domain, options);
        });
    </script>
</body>
</html>
