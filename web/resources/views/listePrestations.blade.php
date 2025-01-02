<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des prestations</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>

@section('content')
<body>
    
        <header>
            <h1>Nos prestations</h1>
            <button id="open-popup-btn" class="btn-primary">Ajouter une nouvelle prestation</button>
        </header>

        <section class="list-section">
            <div class="grid-container">
                @foreach ($listePresta as $presta)
                    <div class="grid-item">
                        <div class="content">
                            <div class="details">
                                <strong>ID :</strong> {{ $presta->service_id }}<br>
                                <strong>Nom :</strong> {{ $presta->title }}<br>
                                <strong>Description :</strong> {{ $presta->description }}<br>
                                <strong>Avantage :</strong> {{ $presta->advantage }}<br>
                                <strong>Situation :</strong> {{ $presta->situations }}<br>
                            </div>
                            <div class="image">
                                @if ($presta->picture)
                                    <img src="{{ asset($presta->picture) }}" alt="{{ $presta->title }}" style="max-width: 90px; max-height: 90px;">
                                    @else
                                    <p>Aucune image</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        

        <!-- Popup -->
        <div id="pop-up" class="popup">
            <div class="popup-content small">
                <span id="close-popup-btn" class="close-btn">&times;</span>
                <h2>Ajouter une nouvelle prestation</h2>
                <form id="creationPrestation" action="creationPrestation" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    
                        <label for="titre">Nom :</label>
                        <input type="text" id="titre" name="titre" required>
                   
                        <label for="advantage">Avantage :</label>
                        <input type="text" id="advantage" name="advantage" required>
                    
                        <label for="description">Description :</label>
                        <input type="text" id="description" name="description" required>
                   
                        <label for="situation">Situation :</label>
                        <input type="text" id="situation" name="situation" required>

                        <label for="image">Image :</label>
                        <input type="file" id="image" name="image" accept="image/*" >
                   
                    <button type="submit" class="btn-submit">Créer</button>
                </form>
            </div>
        </div>
  
</body>

<script>
    document.getElementById('creationPrestation').addEventListener('submit', function(event) {
        const fileInput = document.getElementById('image');
        const maxSize = 2 * 1024 * 1024; // Taille maximale autorisée : 2 Mo
    
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size;
            if (fileSize > maxSize) {
                event.preventDefault(); // Bloque l'envoi du formulaire
                alert('Le fichier est trop lourd. La taille maximale autorisée est de 2 Mo.');
            }
        }
    });
    </script>