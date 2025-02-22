<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un devis pour {{ $devis->first_name}} {{ $devis->last_name}} </title>
    <link rel="stylesheet" href="{{ asset('css/employee/clientDetails.css') }}">
    <script defer src="{{ asset('js/devis.js') }}"></script>
</head>
<body>

    <div class="container">
        <div class="client-profile">
            <h1>Créer un devis pour {{ $devis->first_name }} {{ $devis->last_name }}</h1>
            <a href="{{ route('employees.accueil') }}" class="back-link">Retourner vers le menu</a> 
        </div>

        <!-- Informations du client -->
        <div class="section">
            <h2>Informations du client</h2>
            <p><strong>Nom :</strong> {{ $devis->first_name }} {{ $devis->last_name }}</p>
            <p><strong>Email :</strong> {{ $devis->email }}</p>
            <p><strong>Téléphone :</strong> {{ $devis->phone }}</p>
            <p><strong>Service demandé :</strong> {{ $devis->type_of_service }}</p>
            <p><strong>Message :</strong> {{ $devis->message }}</p>
        </div>

        <!-- Formulaire de création du devis -->
        <div class="section">
            <h2>Établir le devis</h2>
            <form action="{{ route('employees.devis.genererPDF', ['id' => $devis->quote_request_id]) }}" method="POST">

                @csrf
                
                <table id="devisTable">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Total HT</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="devisBody">
                    </tbody>
                </table>
                
                <button type="button" id="ajouterLigne">Ajouter une ligne</button>

                <p><strong>Total HT :</strong> <span id="totalHT">0</span> €</p>
                <p><strong>TVA (20%) :</strong> <span id="tva">0</span> €</p>
                <p><strong>Total TTC :</strong> <span id="totalTTC">0</span> €</p>

                <div class="section">
                    <h3>Commentaires / Remarques</h3>
                    <textarea name="commentaires" rows="4" placeholder="Ajouter des précisions ici..."></textarea>
                </div>

                <button type="submit" class="btn" style="background-color: #2c7d7b">Envoyer le devis</button>
            </form>
        </div>

    </div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("devisBody");
    const ajouterLigneBtn = document.getElementById("ajouterLigne");

    function calculerTotal() {
        let totalHT = 0;
        document.querySelectorAll(".row-total").forEach(cell => {
            totalHT += parseFloat(cell.textContent) || 0;
        });

        document.getElementById("totalHT").textContent = totalHT.toFixed(2);
        let tva = totalHT * 0.2;
        document.getElementById("tva").textContent = tva.toFixed(2);
        document.getElementById("totalTTC").textContent = (totalHT + tva).toFixed(2);
    }

    function ajouterLigne() {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td><input type="text" name="description[]" required></td>
            <td><input type="number" name="quantite[]" class="quantite" min="1" value="1" required></td>
            <td><input type="number" name="prix[]" class="prix" min="0" step="0.01" value="0" required></td>
            <td class="row-total">0</td>
            <td><button type="button" class="supprimer">❌</button></td>
        `;

        tableBody.appendChild(row);
        row.querySelector(".quantite").addEventListener("input", updateRowTotal);
        row.querySelector(".prix").addEventListener("input", updateRowTotal);
        row.querySelector(".supprimer").addEventListener("click", () => {
            row.remove();
            calculerTotal();
        });

        calculerTotal();
    }

    function updateRowTotal(event) {
        const row = event.target.closest("tr");
        const quantite = row.querySelector(".quantite").value;
        const prix = row.querySelector(".prix").value;
        row.querySelector(".row-total").textContent = (quantite * prix).toFixed(2);
        calculerTotal();
    }

    ajouterLigneBtn.addEventListener("click", ajouterLigne);
});
</script>