<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/AdminAccueil.css') }}">
</head>


<body>
    <a href="{{ route('logout') }}"><button>Déconnexion</button></a>
    <div class="containneur">
        <div class="container-inner">
            <strong>Bienvenue, cher Administrateur!</strong>
        </div>
    </div>

    <div class="containneur">
        <div class="container-inner">
            <h2>Gestion des clients</h2>
            <a href="listeClients">Acceder a la liste des clients</a>
        </div>
        <div class="container-inner">
            <h2>Gestion des Employés</h2>
            <a href="listeEmployee">Acceder a la liste des employés</a>
        </div>
        <div class="container-inner">
            <h2>Gestion des prestations</h2>
            <a href="listePrestations">Acceder a la liste des prestations</a>
        </div>
    </div>
</body>




