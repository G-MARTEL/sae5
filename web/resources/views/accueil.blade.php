@extends('layout')

@section('styles')
@endsection


@section('scripts')
@endsection
@section('content')

    
<div id="accueil-1" class="container">
  <figure>
    <img src="https://img.freepik.com/photos-premium/technologie-big-data-pour-concept-finance-entreprise_31965-3011.jpg?w=996" alt="Image de fond">
  </figure>
  <figure>
    <button>Prendre rendez vous</button>
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
    <button class="prev">prev</button>
    <div class="carousel">
        <div class="carousel-item">"Avis 1 : Un service exceptionnel !" - Jean</div>
        <div class="carousel-item">"Avis 2 : Très satisfait du support." - Marie</div>
        <div class="carousel-item">"Avis 3 : Une équipe très réactive." - Paul</div>
    </div>
    <button class="next">next</button>
    <div class="carousel-indicators">
        <span class="dot" data-index="0"></span>
        <span class="dot" data-index="1"></span>
        <span class="dot" data-index="2"></span>
    </div>
</div>

@endsection