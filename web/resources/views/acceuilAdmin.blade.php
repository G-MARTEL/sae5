<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Admin</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin/AdminAccueil.css') }}">
</head>


<body>
    <a href="{{ route('logout') }}"><button class="logout-btn">Déconnexion</button></a>
    
    <div class="container">
        <div class="container-inner">
            <strong>Bienvenue sur votre espace d'administation</strong>
        </div>
    </div>

    <div class="container">
        <div class="container-inner">
            <h2>Gestion des clients</h2>
            <a href="listeClients">Acceder a la liste des clients</a>
        </div>
        <div class="container-inner">
            <h2>Gestion des employés</h2>
            <a href="listeEmployee">Acceder a la liste des employés</a>
        </div>
        <div class="container-inner">
            <h2>Gestion des prestations</h2>
            <a href="listePrestations">Acceder a la liste des prestations</a>
        </div>
    </div>


   
    
</body>

