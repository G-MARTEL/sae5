<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="./css/connexion/page_creation.css"/>
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">



    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>
<body>


    <body>
        <div class="container">
            <h2>Création de compte</h2>
            <form action="creationCompte" method="post">
                @csrf
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
                        <label for="password_confirmation">Confirmer le mot de passe :</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <span id="password-error" style="color: red; display: none;">
                            Les mots de passe ne correspondent pas.
                        </span>
                    </div>
                </div>
                <button type="submit" id="submit-btn" disabled>Créer le compte</button>
            </form>
        </div>
    </body>
    
    
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
</script>

