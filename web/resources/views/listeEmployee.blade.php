<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des employés</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">

    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">



    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Liste des employés</h1>
            <button id="open-popup-btn" class="btn-primary">Créer un profil d'employé</button>
        </header>
        <section class="list-section">
            <input type="text" id="search-input" placeholder="Rechercher un employé..." class="search-bar">
            <a href="{{ route('admin.accueil') }}" class="back-link">Retourner vers le menu</a> 
            <h1>Comptes actifs </h1>
            <div class="grid-container">
                @foreach ($listeEmployees as $employee)
                    @if ($employee->isActif)
                        <div class="grid-item" data-title="{{ $employee->Account->last_name}}-{{$employee->Account->first_name }}">
                            <div class="content">
                                <div class="details">
                                    
                                    <p>
                                        <strong>Nom :</strong> {{ $employee->Account->last_name }}
                                        <strong>Prénom :</strong> {{ $employee->Account->first_name }}
                                    </p>
                                    <form action="modifEmployee" method="post" class="form-inline">
                                        @csrf
                                        <input type="hidden" name="employee_id" value="{{$employee->employee_id}}">
                                        <select name="Funtions_id" id="Functions">
                                            @php
                                            if ($employee->FK_function_id == null)
                                            {
                                                echo '<option value="">Aucun fonction associé</option>';
                                            }
                                            @endphp
                                        @foreach($listeFunction as $Functions)
                                            <option value="{{ $Functions->function_id}}" 
                                                {{ $employee->FK_function_id == $Functions->function_id ? 'selected' : '' }}>
                                                {{ $Functions->function_name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <button type="submit" class="envoyee">Envoyer</button>
                                    </form>
                                    <form action="disableEmployees" method="post">
                                        @csrf
                                        <input type="hidden"  name="idEmployees" value="{{ $employee->employee_id }}">
                                        <button type="submit">Suspendre le compte</button>
                                    </form>
                                </div>
                                <div class="image">
                                    @if ($employee->Account->picture)  
                                        <img src="{{ asset($employee->Account->picture) }}" alt="{{ $employee->Account->first_name }}" class="prestation-image">
                                    @else
                                        <p>Aucune photo</p>
                                    @endif
                                </div> 
                            </div>
                        </div>
                    @endif
                @endforeach
                
            </div>
            <h1>Comptes désactivés  </h1>
            <div class="grid-container">
            
                @foreach ($listeEmployees as $employee)
                    @if (!$employee->isActif)
                        <div class="grid-item" data-title="{{ $employee->Account->last_name}}-{{$employee->Account->first_name }}">
                            <div class="content">
                                <div class="details">
                                    
                                    <p>
                                        <strong>Nom :</strong> {{ $employee->Account->last_name }}
                                        <strong>Prénom :</strong> {{ $employee->Account->first_name }}
                                    </p>
                                    <form action="modifEmployee" method="post" class="form-inline">
                                        @csrf
                                        <input type="hidden" name="employee_id" value="{{$employee->employee_id}}">
                                        <select name="Funtions_id" id="Functions">
                                            @php
                                            if ($employee->FK_function_id == null)
                                            {
                                                echo '<option value="">Aucun fonction associé</option>';
                                            }
                                            @endphp
                                        @foreach($listeFunction as $Functions)
                                            <option value="{{ $Functions->function_id}}" 
                                                {{ $employee->FK_function_id == $Functions->function_id ? 'selected' : '' }}>
                                                {{ $Functions->function_name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <button type="submit" class="envoyee">Envoyer</button>
                                    </form>
                                </div>
                                <div class="image">
                                    @if ($employee->Account->picture)  
                                        <img src="{{ asset($employee->Account->picture) }}" alt="{{ $employee->Account->first_name }}" class="prestation-image">
                                    @else
                                        <p>Aucune photo</p>
                                    @endif
                                </div>                          
                            </div>
                        </div>
                    @endif
                @endforeach
                
            </div>
        </section>

        <!-- Popup -->
        <div id="pop-up" class="popup">
            <div class="popup-content small ">
                <div class="container">

                <span id="close-popup-btn" class="close-btn">&times;</span>
                <h2>Créer un nouvel employé</h2>
                <form id="creationEmployee" action="creationEmployee" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                        {{-- <label for="first_name">Prénom :</label>
                        <input type="text" id="first_name" name="first_name" required>
                        <label for="last_name">Nom :</label>
                        <input type="text" id="last_name" name="last_name" required>
                    
                        <label for="phone">Téléphone :</label>
                        <input type="number" id="phone" name="phone" required>
                 
                        <label for="postal_address">Adresse postale :</label>
                        <input type="text" id="postal_address" name="postal_address" required>
                    
                        <label for="code_address">Code postal :</label>
                        <input type="text" id="code_address" name="code_address" required>
                    
                        <label for="city">Ville :</label>
                        <input type="text" id="city" name="city" required>
                    
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required>
                    
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>
                        <small id="password-hint" style="color: red;">
                            Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre, et un caractère spécial.
                        </small>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le mot de passe :</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                            <span id="password-error" style="color: red; display: none;">
                                Les mots de passe ne correspondent pas.
                            </span>
                        </div> --}}

                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">Prénom :</label>
                                <input type="text" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Nom :</label>
                                <input type="text" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Téléphone :</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="postal_address">Adresse postale :</label>
                                <input type="text" id="postal_address" name="postal_address" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="code_address">Code postal :</label>
                                <input type="text" id="code_address" name="code_address" required>
                            </div>
                            <div class="form-group">
                                <label for="city">Ville :</label>
                                <input type="text" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" id="email" name="email" required>
                            </div>
        
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" id="password" name="password" required>
                                <small id="password-hint" style="color: red;">
                                    Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre, et un caractère spécial.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmer :</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required>
                                <span id="password-error" style="color: red; display: none;">
                                    Les mots de passe ne correspondent pas.
                                </span>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group">
                                <label for="image">Photo :</label>
                                <input type="file" id="image" name="image" accept="image/*" >
                            </div>
                            <div class="form-group">
                            <label for="function">Fonction :</label>
                            <select name="function_id" id="Functions" class="form-select">
                                @foreach ($listeFunction as $Functions)
                                    <option value="{{ $Functions->function_id }}" 
                                        {{ $Functions->function_id ? 'selected' : '' }}>
                                        {{ $Functions->function_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Créer</button>
                </form>
                
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('./js/recherche.js')}}"></script>
</body>


<script>

document.addEventListener('DOMContentLoaded', () => {
        const passwordInput = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');
        const passwordHint = document.getElementById('password-hint');
        const passwordError = document.getElementById('password-error');
        const submitButton = document.getElementById('submit-btn');

        function validatePassword() {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirm.value;

            // Vérification des critères du mot de passe
            const isValidLength = password.length >= 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecialChar = /[@$!%*?.&]/.test(password);

            // Vérification de la correspondance des mots de passe
            const passwordsMatch = password === confirmPassword;

            // Mettre à jour le texte d'aide sur le mot de passe
            if (isValidLength && hasUpperCase && hasNumber && hasSpecialChar) {
                passwordHint.style.color = 'green';
            } else {
                passwordHint.style.color = 'red';
            }

            // Afficher ou masquer l'erreur de confirmation
            if (confirmPassword && !passwordsMatch) {
                passwordError.style.display = 'inline';
            } else {
                passwordError.style.display = 'none';
            }

            // Activer ou désactiver le bouton
            submitButton.disabled = !(
                isValidLength &&
                hasUpperCase &&
                hasNumber &&
                hasSpecialChar &&
                passwordsMatch
            );
        }

        // Ajouter des écouteurs d'événements
        passwordInput.addEventListener('input', validatePassword);
        passwordConfirm.addEventListener('input', validatePassword);

        // Désactiver le bouton au chargement
        submitButton.disabled = true;
    });


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