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
                                <button class="btn-secondary open-modif-popup" data-id="{{ $presta->service_id }}" 
                                    data-title="{{ $presta->title }}" 
                                    data-description="{{ $presta->description }}" 
                                    data-advantage="{{ $presta->advantage }}" 
                                    data-situation="{{ $presta->situations }}" 
                                    data-image="{{ $presta->picture }}">
                                Modifier
                            </button>
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

        <div id="modif-pop-up" class="popup">
            <div class="popup-content small">
                <span id="close-modif-popup-btn" class="close-btn">&times;</span>
                <h2>Modifier la prestation</h2>
                <form id="modifPrestation" action="modifPrestation" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="modif-service-id" name="service_id">
                    
                    <label for="modif-titre">Nom :</label>
                    <input type="text" id="modif-titre" name="titre" required>
        
                    <label for="modif-advantage">Avantage :</label>
                    <input type="text" id="modif-advantage" name="advantage" required>
        
                    <label for="modif-description">Description :</label>
                    <input type="text" id="modif-description" name="description" required>
        
                    <label for="modif-situation">Situation :</label>
                    <input type="text" id="modif-situation" name="situation" required>
        
                    <label for="modif-image">Image :</label>
                    <input type="file" id="modif-image" name="image" accept="image/*">
                    <div id="modif-preview"></div>
        
                    <button type="submit" class="btn-submit">Modifier</button>
                </form>
            </div>
        </div>
        
        

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


    // Ouvrir le popup de modification
document.querySelectorAll('.open-modif-popup').forEach(button => {
    button.addEventListener('click', function() {
        const popup = document.getElementById('modif-pop-up');

        // Préremplir les champs du formulaire
        document.getElementById('modif-service-id').value = this.dataset.id;
        document.getElementById('modif-titre').value = this.dataset.title;
        document.getElementById('modif-description').value = this.dataset.description;
        document.getElementById('modif-advantage').value = this.dataset.advantage;
        document.getElementById('modif-situation').value = this.dataset.situation;

        // Afficher l'image actuelle
        const preview = document.getElementById('modif-preview');
        preview.innerHTML = '';
        if (this.dataset.image) {
            const img = document.createElement('img');
            img.src = `{{ asset('') }}${this.dataset.image}`;
            img.style.maxWidth = '100px';
            img.style.maxHeight = '100px';
            preview.appendChild(img);
        }

        popup.style.display = 'block';
    });
});

// Fermer le popup de modification
document.getElementById('close-modif-popup-btn').addEventListener('click', function() {
    document.getElementById('modif-pop-up').style.display = 'none';
});



</script>