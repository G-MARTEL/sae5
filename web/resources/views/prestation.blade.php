@extends('layout')

@section('styles')
<link rel="stylesheet" href="./css/prestation.css"/>
@endsection


@section('scripts')
@endsection
@section('content')


<div class="container" id="prestation-1">
    <div class="container-inner">
        <h2>titre prestation a gérer en php</h2>
    </div>
</div>

<div class="container" id="prestation-2">
    <div class="container-inner">
        <div class="colonnes">
            <div class="colonne texte-colonne">
                <h3>Assurez-vous une offre de qualité</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
                    doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et 
                    quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur 
                    aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
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
                        <!-- ajouter foreach-->
                         <li>exemple 1</li>
                         <li>exemple 2</li>
                         <li>exemple 3</li>
                    </ul>
            </div>
            <div class="colonne">
                <h3>Situations</h3>
                <ul>
                    <!-- ajouter foreach-->
                    <li>exemple 1</li>
                    <li>exemple 2</li>
                    <li>exemple 3</li>
                </ul>
            </div>
        </div>
    </div>
    <a href="devis">
            Prendre rendez vous
        </a>
</div>




@endsection