@extends('layouts.notification')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes de devis</title>
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css\employee\notifications.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">
    
</head>

<body>
    
<div class="container">
    <header>
        <h1>Demandes de devis</h1>
    </header>

    <section class="list-section">
        <input type="text" id="search-input" placeholder="Rechercher un client..." class="search-bar">
        <a href="{{ route('employees.accueil') }}" class="back-link">Retourner vers le menu</a> 
        <div class="grid-container">
            @foreach ($devisList as $devis)
                <div class="grid-item" data-title="{{ $devis->first_name }}-{{ $devis->last_name }}">
                    <div class="content">
                        <div class="details">
                            <strong>Demande </strong>{{ $devis->type_of_service }}</br>
                            <a href="{{ route('employees.devis.show', $devis->quote_request_id) }}" class="client-link">
                                Consulter le profil
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script src="{{asset('./js/recherche.js')}}"></script>


</body>


    

