@extends('layout')

@section('styles')
@endsection


@section('scripts')
@endsection
@section('content')

    
<div id="accueil-1" class="container first">
  <figure>
    <img src="https://img.freepik.com/photos-premium/technologie-big-data-pour-concept-finance-entreprise_31965-3011.jpg?w=996" alt="Image de fond">
  </figure>
  <figure>
    <a href="devis">
        <button>Prendre rendez vous</button>
    </a>
  </figure>
</div>

<div class="container" id="accueil-2">
    <div class="container-inner">
        <h2>Notre cabinet en trois points</h2>
        <div class="container-columns">
            <div class="column">
                <h3>Expertise</h3>
                <p>Des années d'expérience à votre service pour gérer votre comptabilité.</p>
            </div>
            <div class="column">
                <h3>Proximité</h3>
                <p>Un accompagnement personnalisé et proche de vos besoins.</p>
            </div>
            <div class="column">
                <h3>Fiabilité</h3>
                <p>Nous vous garantissons une gestion rigoureuse et conforme à la loi.</p>
            </div>
        </div>
    </div>
</div>

<div class="container" id="accueil-3">
    <div class="container-inner">
        <h2>Pourquoi nous choisir ?</h2>
        <p>Nous aidons les entreprises à atteindre leurs objectifs financiers en leur offrant 
            un service complet et transparent. De la gestion comptable au conseil fiscal, 
            nous nous engageons à vous fournir des solutions adaptées à vos besoins spécifiques.
        </p>
    </div>
</div>

<div class="container" id="accueil-4">   
    <div class="container-inner">
        <h2>Ils nous ont fait confiance</h2>
        <button class="prev"> <img src="{{ asset('assets/accueil/arrows_l.svg') }}" alt="Flèche gauche"></button>
        <div class="carousel">
            <div class="carousel-item">"Leur service est impeccable et transparent. Je recommande ce cabinet à tous mes collègues entrepreneurs." - Marie Durand</div>
            <div class="carousel-item">"Une équipe très professionnelle qui m'a aidé à clarifier ma comptabilité. Très réactifs et à l'écoute !" - Jean Dupont</div>
            <div class="carousel-item">"Grâce à leurs conseils, j'ai optimisé ma fiscalité et réduit mes coûts de manière significative." - Paul Martin</div>
        </div>
        <button class="next"> <img src="{{ asset('assets/accueil/arrows_r.svg') }}" alt="Flèche gauche"></button>
        <div class="carousel-indicators">
            <span class="dot" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
        </div>
    </div>
</div>

<div class="container" id="accueil-5">
    <div class="container-inner">
        <h2>Et pourquoi pas vous ?</h2>
        <a href="devis">
            <button>Prendre rendez vous</button>
        </a>
    </div> 
</div>

@endsection