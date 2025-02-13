@extends('layouts.notification')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de {{ $client->account->first_name }} {{$client->account->last_name}} </title>
    <link rel="stylesheet" href="{{ asset('css\employee\clientDetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css\employee\notifications.css') }}">
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

    
</head>
<body>
    <div class="client-profile">
        <div class="container-info">
            <h1>Informations sur le client</h1>
        
            <div class="client-info">
                <p><strong>Nom :</strong> {{ $client->account->last_name }}</p>
                <p><strong>Prénom :</strong> {{ $client->account->first_name }}</p>
                <p><strong>Email :</strong> {{ $client->account->email }}</p>
                <p><strong>Téléphone :</strong> {{ $client->account->phone }}</p>
                <p><strong>Adresse postale :</strong> {{ $client->account->postal_address }}</p>
                <p><strong>Code postal :</strong> {{ $client->account->code_address }}</p>
                <p><strong>Ville :</strong> {{ $client->account->city }}</p>
                <p><strong>Date d'inscription' :</strong> {{ $client->account->creation_date }}</p>
            </div>
        </div>
        <h2>Contrats souscrits</h2>
        <table class="contracts-table">
            <thead>
                <tr>
                    <th>Numéro de contrat</th>
                    <th>Type de prestation</th>
                    <th>Date de création</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @if($client->contracts->isEmpty())
                    <tr>
                        <td colspan="4">Aucun contrat souscrit.</td>
                    </tr>
                @else
                    @foreach($client->contracts as $contract)
                        <tr>
                            <td>{{ $contract->numero_contract }}</td>
                            <td>{{ $contract->service->title }}</td>
                            <td>{{ $contract->creation_date }}</td>
                            <td>{{ $contract->is_active ? 'Actif' : 'Inactif' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <h2>Créer un document</h2>
        <form action="{{ route('employees.creationContrat') }}" method="POST" class="create-contract-form">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->client_id }}">
    
            <label for="prestation">Type de prestation :</label>
            <select name="prestation_id" id="prestation" required>
                @foreach ($services as $service)
                    <option value="{{ $service->service_id }}">{{ $service->title }}</option>
                @endforeach
            </select>
    
            <button type="submit">Créer contrat</button>
        </form>
    
        <h2>Documents déposés par le client</h2>
        <table class="documents-table">
            <thead>
                <tr>
                    <th>Nom du fichier</th>
                    <th>Date de dépôt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($client->documents->isEmpty())
                    <tr>
                        <td colspan="3">Aucun document déposé.</td>
                    </tr>
                @else
                    @foreach($client->documents as $document)
                        <tr>
                            <td>{{ $document->title }}</td>
                            <td>{{ $document->date }}</td>
                            <td>
                                <a href="{{ route('download.document', $document->document_id) }}" class="download-link">Télécharger</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    
        <h2>Créer un document</h2>
        <form action="{{ route('documents.store') }}" method="POST" class="create-document-form">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->client_id }}">
            <input type="hidden" name="employee_id" value="{{ $client->FK_employee_id }}">
    
            <label for="title">Titre du document :</label>
            <input type="text" name="title" id="title" required>
    
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" rows="5" required></textarea>
    
            <label for="facture">Est-ce une facture ?</label>
            <select name="facture" id="facture" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
    
            <button type="submit">Créer le document</button>
        </form>
    
        <h2>Documents créés</h2>
        <table class="documents-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($client->createDocuments !== null && $client->createDocuments->isNotEmpty())
                    @foreach ($client->createDocuments as $createDocument)
                        @foreach ($createDocument->contentDocuments as $content)
                            <tr>
                                <td>{{ $content->title }}</td>
                                <td>{{ Str::limit($content->contenu, 50, '...') }}</td>                                
                                <td>{{ $createDocument->facture ? 'Facture' : 'Autre' }}</td>
                                <td>{{ $content->date }}</td>
                                <td><a href="{{ route('documents.downloadDocument', $content->contentdocument_id) }}" class="download-link">Télécharger</a><td>
                            </tr>
                        @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Aucun document n'a été créé pour ce client.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    
        <a href="{{ route('employees.listeClientAttitres') }}" class="back-link">Retour à la liste des clients</a>
    </div>

</body>