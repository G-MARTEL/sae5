<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos clients</title>
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">
    
</head>

<body>
    
<div class="container">
    <header>
        <h1>Mes clients</h1>
    </header>

    <section class="list-section">
        <input type="text" id="search-input" placeholder="Rechercher un client..." class="search-bar">
        <a href="{{ route('employees.accueil') }}" class="back-link">Retourner vers le menu</a> 
        <div class="grid-container">
            @foreach ($clients as $client)
                <div class="grid-item" data-title="{{ $client->account->last_name }}-{{ $client->account->first_name }}">
                    <div class="content">
                        <div class="details">
                            <strong>Prénom: </strong>{{ $client->account->last_name }}</br>
                            <strong>Nom : </strong>{{ $client->account->first_name }}</br>
                            <a href="{{ route('employees.clients.show', $client->client_id) }}" class="client-link">
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

{{-- <div class="employee-clients">
    <h1>Mes clients</h1>
    <a href="{{ route('employees.accueil') }}" class="back-link">Retourner vers le menu</a> 
    <table class="clients-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>      </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->account->last_name }}</td>
                    <td>{{ $client->account->first_name }}</td>
                    <td><a href="{{ route('employees.clients.show', $client->client_id) }}" class="client-link">
                        Consulter le profil
                    </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}