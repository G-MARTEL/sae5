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
    

</body>


