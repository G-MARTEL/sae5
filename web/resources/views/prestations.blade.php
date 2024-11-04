@extends('layout')

@section('styles')
<link rel="stylesheet" href="./css/prestations.css"/>
@endsection


@section('scripts')
@endsection
@section('content')

<?php $texte = "Ceci est un exemple de texte très long qui pourrait contenir plus de 150 caractères, et que l'on veut afficher en version tronquée pour un aperçu rapide.";
$texteLimite = substr($texte, 0, 150);

if (strlen($texte) > 150) {
    $texteLimite .= '...';
}
?>

<div class="container" id="prestations1">
    <h1>Nos prestations</h1>
</div>

<!-- ajouter un foreach -->
<div class="container" id="prestations2">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne">
                <h3> titre</h3>
                <p><?php echo $texteLimite;
                    ?></p>
            </div>
            <div class="colonne">
                <img src="{{ asset('assets/presentation/employe2.jpg') }}" alt="">
            </div>
            <div class="colonne">
                <a href="">Accéder à la prestation</a>
            </div>
        </div>
    </div>
</div>


@endsection