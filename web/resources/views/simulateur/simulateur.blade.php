@extends('layout')


@section('styles')
<link rel="stylesheet" href="{{ asset('css/simulateur/pages.css') }}">
@endsection

@section('content')

<div class="container"style="padding-top:85px; padding-bottom:85px">
<div class="tab-container" >
    <!-- Onglets -->
    <div class="tabs">
      <button class="tab-button active" data-tab="simulator1">Emprunt</button>
      <button class="tab-button" data-tab="simulator2">Epargne</button>
      <button class="tab-button" data-tab="simulator3">Capacité d'emprunt</button>
    </div>
  
    <!-- Contenus des simulateurs -->
    <div class="tab-content">
      <div class="tab-pane active" id="simulator1">
        <h2>Simulateur d'emprunt immobilier</h2>
        <p>Obtenez toutes les informations souhaitées sur les montants de votre prêt : mensualités, coût d'assurance, somme totale...</p>
        <div class="simulator-container">
            <form id="simulateurForm" class="simulator-form">
                <div class="form-group">
                    <label for="capital">Capital souhaité (€)</label>
                    <input type="number" id="capital" name="capital" required>
                </div>
                <div class="form-group">
                    <label for="taux">Taux d'intérêt annuel (%)</label>
                    <input type="number" step="0.01" id="taux" name="taux" required>
                </div>
                <div class="form-group">
                    <label for="duree">Durée du prêt (années)</label>
                    <input type="number" id="duree" name="duree" required>
                </div>
                <div class="form-group">
                    <label for="apport">Apport personnel (€)</label>
                    <input type="number" id="apport" name="apport" value="0">
                </div>
                <div class="form-group">
                    <label for="assurance">Assurance (%)</label>
                    <input type="number" step="0.01" id="assurance" name="assurance" value="0">
                </div>
                <button type="button" id="simulateImmoBtn" class="submit-btn">Calculer</button>
            </form>
        
            <div id="resultContainer" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Capital emprunté : <strong id="capitalEmprunte"></strong> €</li>
                    <li>Mensualité : <strong id="mensualite"></strong> €</li>
                    <li>Total des intérêts : <strong id="totalInterets"></strong> €</li>
                    <li>Mensualité totale (avec assurance) : <strong id="mensualiteTotale"></strong> €</li>
                </ul>
            </div>
        </div>
      </div>
      <div class="tab-pane" id="simulator2">
        <h2>Simulateur d'épargne</h2>
        <p>Calculez ce que vous rapporterai un placement avec capitalisation composée.</p>
        <div class="simulator-container">
            <form id="savingsForm" class="simulator-form">
                <div class="form-group">
                    <label for="initialCapital">Montant initial (€)</label>
                    <input type="number" id="initialCapital" name="initialCapital" required>
                </div>
                <div class="form-group">
                    <label for="rate">Taux d'intérêt annuel (%)</label>
                    <input type="number" step="0.01" id="rate" name="rate" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durée (années)</label>
                    <input type="number" id="duration" name="duration" required>
                </div>
                <div class="form-group">
                    <label for="monthlyContribution">Versement mensuel (€)</label>
                    <input type="number" id="monthlyContribution" name="monthlyContribution" value="0">
                </div>
                <button type="button" id="calculateSavingsBtn" class="submit-btn">Calculer</button>
            </form>
        
            <div id="savingsResultContainer" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Montant total épargné : <strong id="totalAmount"></strong> €</li>
                    <li>Intérêts générés : <strong id="generatedInterest"></strong> €</li>
                </ul>
            </div>
        </div>
      </div>
      <div class="tab-pane" id="simulator3">
        <h2>Simulateur de capacité d'emprunt</h2>
        <p>Calculez le montant maximum que vous pouvez emprunter, et les mensualités qui en découleront. </p>
        <div class="simulator-container">
            <form id="simulateurForm" class="simulator-form">
                <div class="form-group">
                    <label for="revenus">Revenus mensuels (€)</label>
                    <input type="number" id="revenus" name="revenus" required>
                </div>
                <div class="form-group">
                    <label for="charges">Charges mensuelles (€)</label>
                    <input type="number" id="charges" name="charges" required>
                </div>
                <div class="form-group">
                    <label for="tauxEndettement">Taux d'endettement (%)</label>
                    <input type="number" id="tauxEndettement" name="tauxEndettement" value="33" required>
                </div>
                <div class="form-group">
                    <label for="duree2">Durée du prêt (années)</label>
                    <input type="number" id="duree2" name="duree2" required>
                </div>
                <div class="form-group">
                    <label for="tauxInteret">Taux d'intérêt annuel (%)</label>
                    <input type="number" step="0.01" id="tauxInteret" name="tauxInteret" required>
                </div>
                <button type="button" id="simulateCapaciteBtn" class="submit-btn">Calculer</button>
            </form>
    
            <div id="resultContainer2" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Capacité d'emprunt maximale : <strong id="capaciteEmprunt"></strong> €</li>
                    <li>Mensualité maximale : <strong id="mensualiteMaximale"></strong> €</li>
                </ul>
            </div>
      </div>
    </div>
  </div>

</div>

<script>
    document.getElementById('simulateImmoBtn').addEventListener('click', function () {
        const capital = parseFloat(document.getElementById('capital').value);
        const taux = parseFloat(document.getElementById('taux').value) / 100 / 12;
        const duree = parseInt(document.getElementById('duree').value) * 12;
        const apport = parseFloat(document.getElementById('apport').value) || 0;
        const assurance = parseFloat(document.getElementById('assurance').value) / 100 || 0;

        // Calculs
        const capitalEmprunte = capital - apport;
        const mensualite = (capitalEmprunte * taux * Math.pow(1 + taux, duree)) / 
                          (Math.pow(1 + taux, duree) - 1);
        const totalInterets = (mensualite * duree) - capitalEmprunte;
        const assuranceMensuelle = (capitalEmprunte * assurance) / 12;
        const mensualiteTotale = mensualite + assuranceMensuelle;

        // Afficher les résultats
        document.getElementById('capitalEmprunte').textContent = capitalEmprunte.toFixed(2);
        document.getElementById('mensualite').textContent = mensualite.toFixed(2);
        document.getElementById('totalInterets').textContent = totalInterets.toFixed(2);
        document.getElementById('mensualiteTotale').textContent = mensualiteTotale;

        // Afficher la section des résultats
        document.getElementById('resultContainer').style.display = 'block';
    });

    document.getElementById("calculateSavingsBtn").addEventListener("click", function () {
    const initialCapital = parseFloat(document.getElementById("initialCapital").value);
    const rate = parseFloat(document.getElementById("rate").value) / 100; // Convertir en décimal
    const duration = parseFloat(document.getElementById("duration").value);
    const monthlyContribution = parseFloat(document.getElementById("monthlyContribution").value) || 0;

    const n = 12; // Périodes par an (mensuelles)
    const totalPeriods = duration * n; // Nombre total de périodes

    // Calcul du montant avec intérêts composés
    const capitalWithInterest = initialCapital * Math.pow(1 + rate / n, totalPeriods);

    // Calcul des contributions mensuelles
    const contributionWithInterest =
        monthlyContribution *
        ((Math.pow(1 + rate / n, totalPeriods) - 1) / (rate / n));

    // Montant total
    const totalAmount = capitalWithInterest + contributionWithInterest;

    // Intérêts générés
    const generatedInterest = totalAmount - (initialCapital + monthlyContribution * totalPeriods);

    // Afficher les résultats
    document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);
    document.getElementById("generatedInterest").textContent = generatedInterest.toFixed(2);

    document.getElementById("savingsResultContainer").style.display = "block";
    });



    document.getElementById('simulateCapaciteBtn').addEventListener('click', function() {
    // Récupérer les valeurs saisies par l'utilisateur
    const revenus = parseFloat(document.getElementById('revenus').value);
    const charges = parseFloat(document.getElementById('charges').value);
    const tauxEndettement = parseFloat(document.getElementById('tauxEndettement').value) / 100;
    const duree = parseInt(document.getElementById('duree2').value);
    const tauxInteret = parseFloat(document.getElementById('tauxInteret').value) / 100;

    // Vérification des valeurs
    if (isNaN(revenus) || isNaN(charges) || isNaN(tauxEndettement) || isNaN(duree) || isNaN(tauxInteret)) {
        console.error("Une ou plusieurs valeurs d'entrée sont invalides.");
        return;
    }
    const mensualiteMaximale = (revenus - charges) * tauxEndettement;

    if (mensualiteMaximale < 0) {
        console.error("La mensualité maximale ne peut pas être négative.");
        return;
    }

    const n = 12; // Nombre de mois par an
    const N = duree * n; // Durée totale en mois
    const tauxMensuel = tauxInteret / n; // Taux d'intérêt mensuel

    // Vérifiez si tauxMensuel est valide
    if (tauxMensuel <= 0) {
        console.error("Le taux d'intérêt doit être supérieur à zéro.");
        return;
    }

    // Formule pour la capacité d'emprunt
    const capaciteEmprunt = mensualiteMaximale / (tauxMensuel * Math.pow(1 + tauxMensuel, N) / (Math.pow(1 + tauxMensuel, N) - 1));
    console.log(capaciteEmprunt); 
    // Afficher les résultats
    document.getElementById('resultContainer2').style.display = 'block';

    document.getElementById('capaciteEmprunt').textContent = capaciteEmprunt.toFixed(2);
    document.getElementById('mensualiteMaximale').textContent = mensualiteMaximale.toFixed(2);

});



    document.addEventListener('DOMContentLoaded', () => {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
        const targetTab = button.getAttribute('data-tab');

        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanes.forEach(pane => pane.classList.remove('active'));

        button.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
        });
    });
    });



</script>



@endsection
