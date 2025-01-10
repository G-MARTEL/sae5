@extends('layout')
<title>{{$prestation->title}}</title>
@section('styles')
<link rel="stylesheet" href="{{ asset('/css/prestation.css') }}"/>
@endsection


@section('scripts')
@endsection
@section('content')


<?php 
$avantages = "{$prestation->advantage}" ;
$listeAvantages = explode(',',$avantages);

$situations = "{$prestation->situations}";
$listeSituations = explode(',', $situations)

?>

<div class="container" id="prestation-1">
    <div class="container-inner">
        <h2>{{$prestation->title}}</h2>
    </div>
</div>

<div class="container" id="prestation-2">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne texte-colonne">
                <h3>Assurez-vous une offre de qualité</h3>
                <p>{{$prestation->description}}</p>
            </div>
            <div class="colonne images-colonne">
                <h3>Notre équipe</h3>
                <div class="colonnes">
                    @foreach ($employes as $employe)
                    <div class="colonne">
                        <figure>
                            <img src="{{ asset($employe->picture) }}" alt="Photo de {{ $employe->first_name }} {{ $employe->last_name }}">
                            <figcaption>{{ $employe->first_name }} {{ $employe->last_name }}</figcaption>
                        </figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="prestation-3">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne">
                <h3>Avantages</h3>
                    <ul class="styled-list">
                        @foreach ($listeAvantages as $avantage)
                        <li> <?php 
                        $avantage=ucfirst(trim($avantage));
                        echo $avantage ?></li>
                        @endforeach
                    </ul>
            </div>
            <div class="colonne">
                <h3>Situations</h3>
                <ul class="styled-list">
                    @foreach ($listeSituations as $situation)
                    <li><?php 
                    $situation=ucfirst(trim($situation));
                    echo $situation ?></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <a href="{{ route('devis') }}">
            Prendre rendez vous
        </a>
</div>



@endsection