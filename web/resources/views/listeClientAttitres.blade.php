<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos clients</title>
    <link rel="stylesheet" href="{{ asset('css\employee\listeClientAttitres.css') }}">
    
</head>
<div class="employee-clients">
    <h1>Mes clients</h1>
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
</div>

