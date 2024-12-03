<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter contrat</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/listeEmployee.css') }}">

    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>




<h1>Page création de contrats</h1>

<div class="containeur">
    <div class="container-inner">
        @foreach ($clients as $clientData)
        <p>  <strong>Nom et Prénom du client  :</strong> {{$clientData['donneeClient']->first_name.' '.$clientData['donneeClient']->last_name}}
        <br> <strong>Id : </strong>{{$clientData['clientAccounts']->client_id}}
        </p>
        <button id="open-popup-btn">Créer contrat</button>
        @endforeach
        

    </div>
</div>


<!-- Popup -->
<div id="pop-up" class="popup">
    <div class="popup-content">
        <span id="close-popup-btn" class="close-btn">&times;</span>
        <h2>Ajouter une prestation</h2>
        <form id="ajouterPrestation" action="ajouterPrestation" method="POST">
            @csrf 
           
            <label for="prestation">Type de prestation:</label>
            <select name="prestation_id" id="Prestation">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                @endforeach
            </select>
            
            <button type="submit">Créer</button>
        </form>
    </div>
</div>
