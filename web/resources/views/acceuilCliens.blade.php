@extends('layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/espace_client.css') }}"/>
@endsection


@section('scripts')
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
                        <li>Numéro de contrat : 51561565 </li>
                    </ul>
                    <ul>    
                        <li><button>Prendre rdv</button></li>
                    </ul>
                    <ul>    
                        <li><button>Gérer mes engagements</button>          <button id="openModalBtn" class="btn btn-primary">Gérer mes informations</button> </li>
                    </ul>
                    
                </div>
            </div>
            @if (isset($clientData['employee']))
            <div class="colonne">
                    <h3>Mon conseiller</h3>
                    <img src="{{ asset($clientData['employee']->picture) }}" alt="Photo de l'équipe">
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