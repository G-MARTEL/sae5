@extends('layout')

<title>Simulateurs</title>

@section('styles')
<link rel="stylesheet" href="{{ asset('css/simulateur/pages.css') }}">
@endsection

@section('content')

<div class="container"style="padding-top:85px; padding-bottom:85px">
    


<div class="tab-container" >
    <!-- Onglets -->
    <div>
        <h2 style="color:#2c7d7b; margin-top:15px">Besoin de faire des calculs ?</h2>
        <p><strong style="color:#2c7d7b">AvyCompta</strong> est votre partenaire de confiance en matière de comptabilité, 
            offrant une gamme de services adaptée tant aux particuliers qu'aux professionnels.
             Que vous soyez un indépendant, une grande ou petite entreprise, ou un particulier, 
             notre équipe d'experts s'engage à vous fournir un accompagnement personnalisé 
             pour répondre à vos besoins spécifiques. 
             Ces différents simulateurs vous proposent un aperçu des nouveaux services proposés par <strong style="color:#2c7d7b">AvyCompta</strong>. 
        </p>
    </div>
    <h3>Vous êtes un particulier ?</h3>
    <div class="tabs">
      <button class="tab-button active" data-tab="simulator1">Impôt sur le revenu</button>
      <button class="tab-button" data-tab="simulator2">Epargne</button>
      <button class="tab-button" data-tab="simulator3">Capacité d'emprunt</button>
    </div>
  
    <!-- Contenus des simulateurs -->
    <div class="tab-content">
      {{-- <div class="tab-pane active" id="simulator1">
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
      </div> --}}
      <div class="tab-pane active" id="simulator1">
        <h2>Simulateur d'impôt sur le revenu</h2>
        <p>Estimez le montant de votre impôt sur le revenu en fonction de votre situation personnelle.</p>
        <div class="simulator-container">
            <form id="simulateurImpotsForm" class="simulator-form">
                <div class="form-group">
                    <label for="revenuAnnuel">Revenu annuel imposable (€)</label>
                    <input type="number" id="revenuAnnuel" name="revenuAnnuel" required>
                </div>
                <div class="form-group">
                    <label for="situationFamiliale">Situation familiale</label>
                    <select id="situationFamiliale" name="situationFamiliale" required>
                        <option value="1">Célibataire</option>
                        <option value="2">Marié/Pacsé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombreEnfants">Nombre d'enfants à charge</label>
                    <input type="number" id="nombreEnfants" name="nombreEnfants" value="0" required>
                </div>
                <div class="form-group">
                    <label for="deductions">Déductions fiscales (€)</label>
                    <input type="number" id="deductions" name="deductions" value="0">
                </div>
                <button type="button" id="simulateImpotsBtn" class="submit-btn">Calculer</button>
            </form>
    
            <div id="resultImpotsContainer" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Revenu imposable : <strong id="revenuImposable"></strong> €</li>
                    <li>Nombre de parts fiscales : <strong id="partsFiscales"></strong></li>
                    <li>Impôt brut : <strong id="impotBrut"></strong> €</li>
                    <li>Impôt net après déductions : <strong id="impotNet"></strong> €</li>
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
  <h3>Vous êtes un professionnel ?</h3>
  <div class="tabs">
    <button class="tab-button active" data-tab="simulator4">Charges sociales</button>
    <button class="tab-button" data-tab="simulator5">TVA</button>
    <button class="tab-button" data-tab="simulator6">Résultat Fiscal</button>
  </div>

  <div class="tab-content">
    <div class="tab-pane" id="simulator4">
        <h2>Simulateur de Charges Sociales</h2>
        <p>Calculez les charges sociales associées à un salaire brut mensuel et le nombre d'employés.</p>
        <div class="simulator-container">
            <form id="chargesForm" class="simulator-form">
                <div class="form-group">
                    <label for="salaireBrut">Salaire brut mensuel (€)</label>
                    <input type="number" id="salaireBrut" name="salaireBrut" required>
                </div>
                <div class="form-group">
                    <label for="typeContrat">Type de contrat</label>
                    <select id="typeContrat" name="typeContrat" required>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombreEmployes">Nombre d'employés</label>
                    <input type="number" id="nombreEmployes" name="nombreEmployes" value="1" required>
                </div>
                <button type="button" id="simulateChargesBtn" class="submit-btn">Calculer les charges</button>
            </form>
    
            <div id="resultContainer4" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Charges sociales totales : <strong id="chargesTotales"></strong> €</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="simulator5">
        <h2>Simulateur de TVA</h2>
        <p>Calculez le montant de la TVA collectée et déductible, ainsi que la TVA à reverser.</p>
        <div class="simulator-container">
            <form id="simulateurTvaForm" class="simulator-form">
                <div class="form-group">
                    <label for="ventesHt">Ventes HT (€)</label>
                    <input type="number" id="ventesHt" name="ventesHt" required>
                </div>
                <div class="form-group">
                    <label for="achatsHt">Achats HT (€)</label>
                    <input type="number" id="achatsHt" name="achatsHt" required>
                </div>
                <div class="form-group">
                    <label for="tauxTva">Taux de TVA (%)</label>
                    <input type="number" step="0.01" id="tauxTva" name="tauxTva" value="20" required>
                </div>
                <button type="button" id="simulateTvaBtn" class="submit-btn">Calculer</button>
            </form>
    
            <div id="resultContainerTva" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>TVA collectée : <strong id="tvaCollectee"></strong> €</li>
                    <li>TVA déductible : <strong id="tvaDeductible"></strong> €</li>
                    <li>TVA à reverser : <strong id="tvaAReverser"></strong> €</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="simulator6">
        <h2>Simulateur de Résultat Fiscal</h2>
        <p>Calculez votre résultat fiscal en prenant en compte les produits et charges de votre activité.</p>
        <div class="simulator-container">
            <form id="simulateurResultatForm" class="simulator-form">
                <div class="form-group">
                    <label for="produits">Produits d'exploitation (€)</label>
                    <input type="number" id="produits" name="produits" required>
                </div>
                <div class="form-group">
                    <label for="chargesExploitation">Charges d'exploitation (€)</label>
                    <input type="number" id="chargesExploitation" name="chargesExploitation" required>
                </div>
                <div class="form-group">
                    <label for="amortissements">Amortissements (€)</label>
                    <input type="number" id="amortissements" name="amortissements" required>
                </div>
                <div class="form-group">
                    <label for="produitsFinanciers">Produits financiers (€)</label>
                    <input type="number" id="produitsFinanciers" name="produitsFinanciers" required>
                </div>
                <div class="form-group">
                    <label for="chargesFinancieres">Charges financières (€)</label>
                    <input type="number" id="chargesFinancieres" name="chargesFinancieres" required>
                </div>
                <button type="button" id="simulateResultatBtn" class="submit-btn">Calculer</button>
            </form>
    
            <div id="resultContainerResultat" class="result-container" style="display: none;">
                <h2>Résultat de la simulation</h2>
                <ul class="result-list">
                    <li>Résultat fiscal : <strong id="resultatFiscal"></strong> €</li>
                </ul>
            </div>
        </div>
    </div>

  </div>
</div>


<script>
  document.getElementById('simulateImpotsBtn').addEventListener('click', function () {
    // Inputs
    const revenuAnnuel = parseFloat(document.getElementById('revenuAnnuel').value);
    const situationFamiliale = parseInt(document.getElementById('situationFamiliale').value);
    const nombreEnfants = parseInt(document.getElementById('nombreEnfants').value);
    const deductions = parseFloat(document.getElementById('deductions').value) || 0;

    // Barème d'imposition (France 2024, tranches en €)
    const bareme = [
        { plafond: 10777, taux: 0 },
        { plafond: 27478, taux: 0.11 },
        { plafond: 78570, taux: 0.30 },
        { plafond: 168994, taux: 0.41 },
        { plafond: Infinity, taux: 0.45 },
    ];

    // Calcul du quotient familial
    const partsFiscales = situationFamiliale + (nombreEnfants > 2 ? 2 + (nombreEnfants - 2) * 0.5 : nombreEnfants * 0.5);
    const revenuImposableParPart = (revenuAnnuel - deductions) / partsFiscales;

    // Calcul de l'impôt par tranche pour une part
    let impotParPart = 0;
    let revenuRestant = revenuImposableParPart;

    let trancheInf = 0; // Plafond inférieur (initialement 0)

    for (const tranche of bareme) {
    if (revenuRestant <= 0) break;
    const montantTranche = Math.min(revenuRestant, tranche.plafond - trancheInf);
    impotParPart += montantTranche * tranche.taux;
    revenuRestant -= montantTranche;
    trancheInf = tranche.plafond;
}

    // Calcul de l'impôt brut total
    const impotBrut = impotParPart * partsFiscales;

    // Application d'un impôt minimum de 0 €
    const impotNet = Math.max(0, Math.round(impotBrut));

    // Afficher les résultats
    document.getElementById('revenuImposable').textContent = (revenuAnnuel - deductions).toFixed(2);
    document.getElementById('partsFiscales').textContent = partsFiscales.toFixed(1);
    document.getElementById('impotBrut').textContent = Math.round(impotBrut);
    document.getElementById('impotNet').textContent = Math.round(impotNet);

    // Afficher la section des résultats
    document.getElementById('resultImpotsContainer').style.display = 'block';
});


document.getElementById('simulateTvaBtn').addEventListener('click', function() {
        const ventesHt = parseFloat(document.getElementById('ventesHt').value);
        const achatsHt = parseFloat(document.getElementById('achatsHt').value);
        const tauxTva = parseFloat(document.getElementById('tauxTva').value) / 100;
        if (isNaN(ventesHt) || isNaN(achatsHt) || isNaN(tauxTva)) {
            console.error("Une ou plusieurs valeurs d'entrée sont invalides.");
            return;
        }

        const tvaCollectee = ventesHt * tauxTva;
        const tvaDeductible = achatsHt * tauxTva;
        const tvaAReverser = tvaCollectee - tvaDeductible;
        document.getElementById('resultContainerTva').style.display = 'block';
        document.getElementById('tvaCollectee').textContent = tvaCollectee.toFixed(2);
        document.getElementById('tvaDeductible').textContent = tvaDeductible.toFixed(2);
        document.getElementById('tvaAReverser').textContent = tvaAReverser.toFixed(2);
    });

    document.getElementById('simulateChargesBtn').addEventListener('click', function() {
        console.log("simulate");
        const salaireBrut = parseFloat(document.getElementById('salaireBrut').value);
        const typeContrat = document.getElementById('typeContrat').value;
        const nombreEmployes = parseInt(document.getElementById('nombreEmployes').value);

        let tauxCharges;
        if (typeContrat === 'CDI') {
            tauxCharges = 0.25;
        } else if (typeContrat === 'CDD') {
            tauxCharges = 0.30;
        } else if (typeContrat === 'Freelance') {
            tauxCharges = 0.15;
        }

        const chargesMensuelles = salaireBrut * tauxCharges;
        const chargesTotales = chargesMensuelles * nombreEmployes;

        document.getElementById('chargesTotales').textContent = chargesTotales.toFixed(2);
        document.getElementById('resultContainer4').style.display = 'block';
    });


    // document.getElementById('simulateImmoBtn').addEventListener('click', function () {
    //     const capital = parseFloat(document.getElementById('capital').value);
    //     const taux = parseFloat(document.getElementById('taux').value) / 100 / 12;
    //     const duree = parseInt(document.getElementById('duree').value) * 12;
    //     const apport = parseFloat(document.getElementById('apport').value) || 0;
    //     const assurance = parseFloat(document.getElementById('assurance').value) / 100 || 0;

    //     const capitalEmprunte = capital - apport;
    //     const mensualite = (capitalEmprunte * taux * Math.pow(1 + taux, duree)) / 
    //                       (Math.pow(1 + taux, duree) - 1);
    //     const totalInterets = (mensualite * duree) - capitalEmprunte;
    //     const assuranceMensuelle = (capitalEmprunte * assurance) / 12;
    //     const mensualiteTotale = mensualite + assuranceMensuelle;

    //     document.getElementById('capitalEmprunte').textContent = Math.round(capitalEmprunte);
    //     document.getElementById('mensualite').textContent = Math.round(mensualite);
    //     document.getElementById('totalInterets').textContent = Math.round(totalInterets);
    //     document.getElementById('mensualiteTotale').textContent = Math.round(mensualiteTotale);

    //     document.getElementById('resultContainer').style.display = 'block';
    // });

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

            // Désactiver les onglets et sections actifs
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Activer l'onglet et la section sélectionnés
            button.classList.add('active');
            const activePane = document.getElementById(targetTab);
            activePane.classList.add('active');

            // Faire défiler jusqu'à la section cible
            activePane.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
});


//     const tabButtons = document.querySelectorAll('.tab-button');
// tabButtons.forEach(button => {
//   button.addEventListener('click', function() {
//     const tabId = this.getAttribute('data-tab');
//     const tabPane = document.getElementById(tabId);
    
//     if (tabPane) {
//       tabPane.scrollIntoView({ behavior: 'smooth' });
//     }
    
//     tabButtons.forEach(btn => btn.classList.remove('active'));
//     this.classList.add('active');
//   });
// });



</script>



@endsection
