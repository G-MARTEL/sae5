<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des prestations</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">

    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>

@section('content')
<body>
    
        <header>
            <h1>Nos prestations</h1>
            <button id="open-popup-btn" class="btn-primary">Ajouter une nouvelle prestation</button>
        </header>

     
        <section class="list-section">
            <input type="text" id="search-input" placeholder="Rechercher une prestation..." class="search-bar">
            <a href="{{ route('admin.accueil') }}" class="back-link">Retourner vers le menu</a> 
            <div class="grid-container">
                @foreach ($listePresta as $presta)
<<<<<<< HEAD
                <div class="grid-item">
                    <div class="content">
                        <div class="details">
                            <!-- Détails de la prestation -->
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
=======
                    <div class="grid-item" data-title="{{ $presta->title }}">
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
>>>>>>> 0aa30a69bea6b84f55eba8ba9da5f5fb3503c514
                            </button>
                            <!-- Nouveau bouton pour gérer les employés -->
                            <button class="btn-secondary open-employee-popup" data-id="{{ $presta->service_id }}">
                                Gérer les employés
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
<<<<<<< HEAD



        <div id="employee-pop-up" class="popup">
            <div class="popup-content small">
                <span id="close-employee-popup-btn" class="close-btn">&times;</span>
                <h2>Gérer les employés</h2>
                <form id="employeeForm" action="updateEmployees" method="POST">
                    @csrf
                    <input type="hidden" id="service-id" name="service_id">
                    <div id="employee-list">
                        <!-- La liste des employés sera injectée ici via JavaScript -->
                    </div>
                    <button type="submit" class="btn-submit">Enregistrer</button>
                </form>
            </div>
        </div>
        
        
  
=======
        <script src="{{asset('./js/recherche.js')}}"></script>

>>>>>>> 0aa30a69bea6b84f55eba8ba9da5f5fb3503c514
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
        document.getElementById('modif-service-id').value = this.dataset.id || '';
        document.getElementById('modif-titre').value = this.dataset.title || '';
        document.getElementById('modif-description').value = this.dataset.description || '';
        document.getElementById('modif-advantage').value = this.dataset.advantage || '';
        document.getElementById('modif-situation').value = this.dataset.situation || '';

        // Afficher l'image actuelle
        const preview = document.getElementById('modif-preview');
        preview.innerHTML = '';
        if (this.dataset.image) {
            const img = document.createElement('img');
            img.src = `${this.dataset.image}`; // Assurez-vous que `this.dataset.image` contient un chemin complet
            img.style.maxWidth = '100px';
            img.style.maxHeight = '100px';
            preview.appendChild(img);
        }

        // Ajouter la classe active pour afficher le popup
        popup.classList.add('active');
    });
});

// Fermer le popup de modification
document.getElementById('close-modif-popup-btn').addEventListener('click', function() {
    const popup = document.getElementById('modif-pop-up');
    popup.classList.remove('active');
});

// Fermer le popup en cliquant en dehors du contenu
document.getElementById('modif-pop-up').addEventListener('click', function(event) {
    if (event.target === this) {
        this.classList.remove('active');
    }
});

document.querySelectorAll('.open-employee-popup').forEach(button => {
    button.addEventListener('click', async function () {  // Ajoutez 'async' ici
        const serviceId = this.getAttribute('data-id');
        document.getElementById('service-id').value = serviceId;

        try {
            // Charger la liste des employés avec await
            const response = await fetch(`/admin/getEmployeesForService/${serviceId}`);
            console.log("Réponse brute :", response);

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();  // Attendez la réponse JSON
            console.log('Réponse JSON :', data);  // Affiche la réponse JSON dans la console

            // Vérifier si 'employees' et 'assignedEmployees' existent
            if (Array.isArray(data.employees) && Array.isArray(data.assignedEmployees)) {
                const employeeListContainer = document.getElementById('employee-list');
                employeeListContainer.innerHTML = ''; // Clear the list before adding new employees

                // Afficher les employés assignés (cases cochées)
                data.employees.forEach(employee => {
                    const employeeItem = document.createElement('div');
                    employeeItem.classList.add('employee-item');

                    // Créer une case à cocher
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'employee_ids[]'; // Changez ici
                    checkbox.value = employee.employee_id; // L'ID de l'employé

                    // Ajouter l'état de la case à cocher (cochez les employés assignés)
                    checkbox.checked = data.assignedEmployees.includes(employee.employee_id); // Si l'employé est assigné

                    // Créer une étiquette pour afficher le nom de l'employé
                    const label = document.createElement('label');
                    if (employee.account && employee.account.first_name && employee.account.last_name) {
                        label.textContent = `${employee.account.first_name} ${employee.account.last_name}`;
                    } else {
                        label.textContent = 'Nom inconnu';  // Afficher un message par défaut si les infos sont manquantes
                    }

                    // Ajouter l'élément à la liste
                    employeeItem.appendChild(checkbox);
                    employeeItem.appendChild(label);
                    employeeListContainer.appendChild(employeeItem);
                });
            }

            // Afficher la popup
            document.getElementById('employee-pop-up').style.display = 'block';

        } catch (error) {
            console.error('Erreur lors du chargement des employés :', error);
            alert('Une erreur est survenue. Vérifiez que la route renvoie une réponse valide.');
        }
    });
});


// Fermer la popup
document.getElementById('close-employee-popup-btn').addEventListener('click', function () {
    document.getElementById('employee-pop-up').style.display = 'none';
});



</script>