<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}"/>
        <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

        <title>Conversations</title>
     </head>


<body>


<div class="container">
    <header>
        <h1>Vos conversations</h1>
    </header>

    <section class="list-section">
        <input type="text" id="search-input" placeholder="Rechercher une conversation..." class="search-bar">
        <a href="{{ route('employees.accueil') }}" class="back-link">Retourner vers le menu</a> 
        <div class="grid-container">
            @foreach ($conversations as $conversation)
                <div class="grid-item" data-title="{{ $conversation->client->Account->first_name}}-{{ $conversation->client->Account->last_name}}">
                    <div class="content">
                        <div class="details">
                            <p>
                                <strong>Conversation numéro {{ $conversation->conversation_id}}</strong> <br/>
                                <strong>Prénom: </strong> {{ $conversation->client->Account->first_name}}<br/>
                                <strong>Nom : </strong> {{ $conversation->client->Account->last_name}}<br/>
                                <strong>Etat : </strong> {{ $conversation->is_active? 'ouvert' : 'fermé' }}<br/>
                                <a href="conversation/{{ $conversation->conversation_id }}" class="button-link">Accéder à la conversation</a>

                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>
<script src="{{asset('./js/recherche.js')}}"></script>






           
