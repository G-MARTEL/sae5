<h2>Création de compte</h2>
    <form action="creationCompte" method="post">
        @csrf
        <label for="first_name">Prénom :</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>

        <label for="last_name">Nom :</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>

        <label for="phone">Téléphone :</label>
        <input type="tel" id="phone" name="phone" required>
        <br>

        <label for="postal_address">Adresse postale :</label>
        <input type="text" id="postal_address" name="postal_address" required>
        <br>

        <label for="code_address">Code postal :</label>
        <input type="text" id="code_address" name="code_address" required>
        <br>

        <label for="city">Ville :</label>
        <input type="text" id="city" name="city" required>
        <br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="creation_date">Date de création :</label>
        <input type="date" id="creation_date" name="creation_date" required>
        <br>

        <button type="submit">Créer le compte</button>
    </form>