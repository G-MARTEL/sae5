<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
        <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

        @yield('styles')
    {{-- @yield('script') --}}
     </head>
    <body>
    <nav class="navbar">
        <div class="logo"><a href="{{ route('accueil2') }}"> <img src="{{ asset("assets\communs\logo_avycompta.png") }}" alt="Logo"></a>
            
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('presentation') }}">Qui sommes-nous ?</a></li>
            <li><a href="{{ route('prestations') }}">Prestations </a></li>
            <li><a href="{{ route('simulateur') }}">Simulateurs </a></li>
            <li><a href="{{ route('devis') }}">Faire un devis</a></li>
        </ul>
        <div class="nav-btn">
            @if (Session::has('role'))
                @if (Session::get('role') === 'client')
                    <a href="{{ route('client.accueil') }}"><button>Profil</button></a>
                    <a href="{{ route('client.messagerie') }}"><button>Messagerie</button></a>
                @elseif (Session::get('role') === 'employee')
                    <a href="{{ route('employees.accueil') }}"><button>Espace Employé</button></a>
                    <a href="{{ route('admin.accueil') }}"><button>Messagerie</button></a>
                @elseif (Session::get('role') === 'admin')
                    <a href="{{ route('admin.accueil') }}"><button>Espace Admin</button></a>
                @endif
                <a href="{{ route('logout') }}"><button style="background-color: #da4837; hover:">Déconnexion</button></a>
            @else
                <a href="{{ route('login') }}"><button>Connexion</button></a>
            @endif
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
                <li><a href="#"><img src="{{ asset("assets\communs\logo_linkedin.png") }}" alt="LinkedIn"></a></li>
                <li><a href="#"><img src="{{ asset("assets\communs\logo_facebook.png") }}" alt="Facebook"></a></li>
                <li><a href="#"><img src="{{ asset("assets\communs\logo_instagram.png") }}" alt="Instagram"></a></li>
            </ul>
        </div>
    </footer>
    
    </body>
</html>

