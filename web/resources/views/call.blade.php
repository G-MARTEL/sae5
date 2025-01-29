<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appel Vidéo</title>
</head>
<body>

    <h1>Appel Vidéo Privé</h1>

    <div id="jitsi-container" style="width: 100%; height: 500px;"></div>

    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        const domain = "meet.jit.si";
        const roomName = "{{ $room }}"; // Génération dynamique du nom de la salle
        const options = {
            roomName: roomName,
            width: "100%",
            height: 500,
            parentNode: document.getElementById("jitsi-container"),
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>

</body>
</html>
