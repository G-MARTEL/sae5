<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="./css/connexion/pages.css"/>


    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>
<body>

    <div class="container">
        <h1>Connexion</h1>
        <form action="connexion" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
            @if ($errors->any())
            <div class="center-child error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <a href="creationCompte">Créer un Compte</a>
    </div>
    



</body>
