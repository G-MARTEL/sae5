<form action="{{ route('simulateur-pret') }}" method="POST">
    @csrf
    <label for="capital">Montant emprunté (€) :</label>
    <input type="number" name="capital" id="capital" required>

    <label for="taux">Taux d’intérêt annuel (%) :</label>
    <input type="number" name="taux" id="taux" step="0.01" required>

    <label for="duree">Durée du prêt (en années) :</label>
    <input type="number" name="duree" id="duree" required>

    <label for="apport">Apport personnel (€) :</label>
    <input type="number" name="apport" id="apport">

    <label for="assurance">Assurance emprunteur (% annuel) :</label>
    <input type="number" name="assurance" id="assurance" step="0.01">

    <button type="submit">Simuler</button>
</form>



