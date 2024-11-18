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
                    <h2>Bienvenue, {{ $clientData['account']->first_name }} {{ $clientData['account']->last_name }}</h1>
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
                        <li><button>Gérer mes engagements</button>          <button>Gérer mes informations</button> </li>
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




@endsection
