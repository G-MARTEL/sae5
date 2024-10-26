<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/styles.css"/>
        @yield('styles')
    @yield('script')
     </head>
    <body>
    <nav class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo"> <!-- Insère ici ton logo -->
        </div>
        <ul class="nav-links">
            <li><a href="Qui-Somme-Nous">Qui Somme Nous ?</a></li>
            <li><a href="prestation">Prestation </a></li>
            <li><a href="simulateur">Simulateurs </a></li>
            <li><a href="devis">Faire un devis</a></li>
        </ul>
        <div class="nav-btn">
        <a href="{{ route('login') }}"><button>Connexion </button></a>
        </div>
    </nav>
        
        @yield('content')
        <footer class="footer">
        <div class="footer-section">
            <h4>Notre cabinet</h4>
            <ul>
                <li><a href="#">Notre équipe</a></li>
                <li><a href="#">Nos prestations</a></li>
                <li><a href="#">Faire devis</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Nos ressources</h4>
            <ul>
                <li><a href="#">Simulateur en ligne</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Réseaux sociaux</h4>
            <ul class="social-icons">
                <li><a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a></li>
                <li><a href="#"><img src="facebook-icon.png" alt="Facebook"></a></li>
                <li><a href="#"><img src="instagram-icon.png" alt="Instagram"></a></li>
            </ul>
        </div>
    </footer>
    <script src="./js/scripts.js"></script>
    </body>
</html>