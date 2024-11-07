@extends('layout')

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
                    <div class="colonne">
                        <figure>
                            <img src="{{ asset('assets/presentation/employe1.jpg') }}" alt="Photo de l'équipe">
                        </figure>
                    </div>
                    <div class="colonne">
                        <figure>
                            <img src="{{ asset('assets/presentation/employe2.jpg') }}" alt="Photo de l'équipe">
                        </figure>
                    </div>
                    <div class="colonne">
                        <figure>
                            <img src="{{ asset('assets/presentation/employe3.jpg') }}" alt="Photo de l'équipe">
                        </figure>
                    </div>
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
                    <ul>
                        @foreach ($listeAvantages as $avantage)
                        <li> <?php 
                        $avantage=ucfirst(trim($avantage));
                        echo $avantage ?></li>
                        @endforeach
                    </ul>
            </div>
            <div class="colonne">
                <h3>Situations</h3>
                <ul>
                    @foreach ($listeSituations as $situation)
                    <li><?php 
                    $situation=ucfirst(trim($situation));
                    echo $situation ?></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <a href="devis">
            Prendre rendez vous
        </a>
</div>




@endsection