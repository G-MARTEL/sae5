<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/listeEmployee.css') }}">


    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>


<button id="open-popup-btn">Créer un nouvel utilisateur</button>

<!-- Popup -->
<div id="pop-up" class="popup">
    <div class="popup-content">
        <span id="close-popup-btn" class="close-btn">&times;</span>
        <h2>Créer un nouvel Employee</h2>
        <form id="creationPrestation" action="creationPrestation" method="POST">
            @csrf 
            <div>
                <label for="titre">Titre:</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div>
                <label for="advantage">Avantage:</label>
                <input type="texte" id="advantage" name="advantage" required>
            </div>
            <div>
                <label for="description">description:</label>
                <input type="texte" id="description" name="description" required>
            </div>
            <div>
                <label for="situation">Situation:</label>
                <input type="text" id="situation" name="situation" required>
            </div>
            <button type="submit">Créer</button>
        </form>
    </div>
</div>

<h1>voici la liste des prestations</h1>

@foreach ($listePresta as $presta)
    <div>
        <strong> id de la presta :</strong> {{ $presta->service_id}}<br/>
        <strong>titre  : </strong>{{ $presta->title}}<br/>
        <strong>decription : </strong>{{ $presta->description}}<br/>
        <strong>avantage : </strong>{{ $presta->advantage}}<br/>
        <strong>situation : </strong>{{ $presta->situations}}<br/>
    </div>
    <br>
@endforeach