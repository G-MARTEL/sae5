@extends('layout')
<title>Qui sommes-nous</title>
@section('styles')
<link rel="stylesheet" href="./css/presentation.css"/>
@endsection


@section('scripts')
@endsection
@section('content')


<div class="container first" id="presentation-1">
    <h2>Une petite présentation s'impose</h2>
    <div class="container-inner"> 
        <p>Depuis sa création en 1995, AvyCompta s'efforce d'apporter une expertise comptable 
            de qualité à ses clients. Avec plus de 25 ans d'expérience, 
            nous sommes un partenaire de confiance pour les entreprises de toutes tailles.</p>
    </div>
</div>

<div class="container" id="presentation-2">
    <div class="container-inner">
        <h3>Nos valeurs</h3>
        <div class="colonnes">
            <div class="colonne">
                <figure><img src="{{ asset('assets/presentation/rigueur.svg') }}" alt="Rigueur"></figure>
                <h4>Rigueur</h4>
                <p>Notre cabinet met un point d’honneur à offrir une expertise comptable précise et fiable. Chaque détail compte pour nous.</p>
            </div>
            <div class="colonne">
                <figure><img src="{{ asset('assets/presentation/transparence.svg') }}" alt="transparence"></figure>
                <h4>Transparence</h4>
                <p>Nous croyons fermement en une communication ouverte et claire avec nos clients. </p>
            </div>
            <div class="colonne">
                <figure><img src="{{ asset('assets/presentation/proximite.svg') }}" alt="proximité"></figure>
                <h4>Proximité</h4>
                <p>Notre mission est de vous accompagner à chaque étape, en vous offrant des solutions adaptées à vos besoins spécifiques. </p>
            </div>
        </div>
    </div>
</div>

<div class="container" id="presentation-3">
    <div class="container-inner">
        <h3>
            Rencontrez notre équipe :
        </h3>
        <div class="colonnes">
            <div class="colonne">
                <figure>
                    <img src="{{ asset('assets/presentation/employe1.jpg') }}" alt="proximité">
                </figure>
                <p>
                    Paul Lambert apporte au cabinet sa riche expérience en comptabilité et en gestion, acquise au fil de ses 12 années de carrière. Il est spécialisé dans l’accompagnement des startups et des jeunes entreprises, les 
                    aidant à naviguer dans les défis financiers avec clarté et pragmatisme. Paul croit fermement à l’importance d’une relation de confiance avec les clients, qu’il considère comme le cœur de son métier. Sa capacité à vulgariser
                     des concepts comptables complexes en fait un conseiller apprécié des entrepreneurs débutants. 
                    Lorsqu’il n’est pas en rendez-vous client, Paul aime explorer de nouvelles solutions pour optimiser les processus internes et améliorer la qualité des services.                 
                </p>
            </div>

            <div class="colonne">
                <figure>
                    <img src="{{ asset('assets/presentation/employe2.jpg') }}" alt="proximité">
                </figure>
                <p>Marie Dupont est une experte-comptable diplômée, passionnée par la gestion d’entreprise et l’accompagnement 
                    personnalisé des clients. Avec plus de 15 ans d’expérience dans des cabinets renommés, elle a décidé de fonder ce cabinet pour offrir des 
                    services sur-mesure et accessibles. Marie est spécialisée dans la fiscalité des PME et la gestion de patrimoine, et son approche est toujours centrée sur la compréhension des besoins uniques de ses 
                    clients. Animée par un fort esprit d’innovation, elle veille à ce que le cabinet reste à la pointe des nouvelles technologies pour simplifier la vie de ses clients.
                </p>
            </div>

            <div class="colonne">
                <figure>
                    <img src="{{ asset('assets/presentation/employe3.jpg') }}" alt="proximité">
                </figure>
                <p>
                    Antoine Morel est un passionné d’analyse financière et de stratégie d’entreprise, avec un parcours de 10 ans dans les grands groupes internationaux. Il excelle dans l’interprétation des données financières pour aider les clients à
                     prendre des décisions éclairées. Antoine se distingue par sa capacité à transformer les chiffres en opportunités stratégiques, apportant ainsi une valeur ajoutée unique au cabinet. Sa spécialité inclut également les audits financiers et les conseils en restructuration, 
                     domaines dans lesquels il a acquis une expertise reconnue. 
                  </p>
            </div>
        </div>
    </div>
    <div class="container-inner">
        <p>
        Et 15 autres spécialistes qui seront heureux de vous accompagner tout au long de votre projet. Notre équipe se 
        compose d'experts comptables et de conseillers financiers passionnés, dotés d'une expérience solide dans divers secteurs d'activité. 
        Chacun de nos collaborateurs met à profit ses compétences pour vous offrir des solutions sur-mesure adaptées à vos besoins.
        <br><br>
        Engagés dans une démarche de proximité et d'excellence, nos spécialistes travaillent main dans la 
        main pour garantir une gestion optimale de vos finances et une réponse rapide à toutes vos questions.
        </p>
    </div>
</div>

<div class="container" id="presentation-4">
    <div class="container-inner">
        <h1>
            Votre projet, notre prochaine réussite !
        </h1>
    </div>

</div>



@endsection