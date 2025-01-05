@extends('layout')
<title>Votre profil</title>
@section('styles')
<link rel="stylesheet" href="{{ asset('/css/espace_client.css') }}"/>
@endsection


@section('scripts')
<script src="{{asset('./js/scriptAccueil.js')}}"defer></script>
@endsection
@section('content')




<div class="container" id="client-1">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne">
                <div class="container-inner">
                    <h2>Bienvenue, {{ $clientData['account']->first_name }} {{ $clientData['account']->last_name }}</h2>

                    <ul>
                        <li>Email : {{ $clientData['account']->email }}</li>
                        <li>Téléphone : {{ $clientData['account']->phone }}</li>
                        <li>Adresse : {{ $clientData['account']->postal_address }}, {{ $clientData['account']->code_address }} {{ $clientData['account']->city }}</li>
                        <li>  
                            @if($contrats->isNotEmpty())
                            <p>Mes contrats actifs : </p>

                                @foreach ($contrats as $contrat)
                                    <li>Numéro de contrat : {{$contrat->numero_contract}} <form method="GET" action="{{ route('download.contract', $contrat->contract_id) }}" style="display:inline;">
                                        <a href="{{ route('download.contract', $contrat->contract_id) }}" class="link-download" style="text-decoration: none; cursor: pointer;">
                                            Télécharger le contrat
                                        </a>                                    </form> <li>
                                        
                                @endforeach
                            @else
                                <p>Vous n'avez pas encore de contrat, contactez nous vite !</p>
                            @endif
                        </li>
                    </ul>
                    <ul>
                        <form method="POST" action="{{ route('client.upload.document') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="document" class="form-label">Déposer un document PDF</label>
                                <input type="file" class="form-control" id="document" name="document" accept="application/pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Déposer</button>
                        </form>
                    </ul>
                    
                    <div class="documents-section">
                        <h2>Documents associés</h2>
                        @if($documents->isEmpty())
                            <p>Aucun document associé.</p>
                        @else
                            @foreach ($documents as $document)
                                <div class="document">
                                    <h3>
                                        @if($document->facture)
                                            Facture
                                        @else
                                            Autre
                                        @endif
                                    </h3>
                                    @foreach ($document->contentDocuments as $content)
                                        <p><strong>Créé le :</strong> {{ \Carbon\Carbon::parse($content->date)->format('d/m/Y') }}</p>
                                        <p><strong>{{ $content->title }} :</strong> {{ $content->contenu }}</p>
                                    @endforeach
                                    <a href="{{ route('download.document.client', ['id' => $document->createdocument_id]) }}" class="btn btn-primary">Télécharger</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    


                    <ul>    
                        <button id="openModalBtn" class="btn btn-primary">Gérer mes informations</button> </li>
                    </ul>
                    
                </div>
            </div>
            @if (isset($clientData['employee']))
            <div class="colonne">
                    <h3>Mon conseiller</h3>
                    <img src="{{ asset($clientData['employee']->picture) }}" alt="{{$clientData['employee']->first_name}} {{ $clientData['employee']->last_name }} ">
                    <ul>
                        <li>{{ $clientData['employee']->first_name }}</li>
                        <li>{{ $clientData['employee']->last_name }}</li>
                        <li>{{ $clientData['employee']->email }}</li>
                    </ul>
                    <button>Envoyer un message</button>
            </div>
            @endif
        </div>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier mes informations</h5>
            <button type="button" id="closeModalBtn" class="btn-close" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Formulaire pour la mise à jour des informations -->
            <form method="POST" action="{{ route('client.update') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $clientData['account']->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $clientData['account']->phone }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $clientData['account']->postal_address }}">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $clientData['account']->city }}">
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>


@endsection
<script src="{{asset('./js/scriptPopUpClient.js')}}"></script>