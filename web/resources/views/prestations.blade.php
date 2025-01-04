@extends('layout')

@section('styles')
<link rel="stylesheet" href="./css/prestations.css"/>
@endsection


@section('scripts')
@endsection
@section('content')



<div class="container" id="prestations-1">
    <h1>Nos prestations</h1>
</div>

@foreach ($prestations as $prestation)

<?php $texte = "{$prestation->description}" ;
$texteLimite = substr($texte, 0, 150);

if (strlen($texte) > 150) {
    $texteLimite .= '...';
}
?>
<div class="container" id="prestations-2">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne">
                <h3> {{$prestation->title}}</h3>
                <p><?php echo $texteLimite;
                    ?></p>
            </div>
            <div class="colonne">
                <img src="{{ asset($prestation->picture) }}" alt="{{$prestation->title}}">
            </div>
            <div class="colonne">
                <a href="{{ route('prestation.show', $prestation->service_id)}}">Accéder à la prestation</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection