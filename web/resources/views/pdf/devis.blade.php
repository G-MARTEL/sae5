<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Devis #{{ $devis->quote_request_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Devis pour {{ $devis->first_name }} {{ $devis->last_name }}</h1>
    <p>Email : {{ $devis->email }}</p>
    <p>Téléphone : {{ $devis->phone }}</p>
    <p>Service demandé : {{ $devis->type_of_service }}</p>

    <h2>Détails du devis</h2>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailsDevis as $ligne)
                <tr>
                    <td>{{ $ligne['description'] }}</td>
                    <td>{{ $ligne['quantite'] }}</td>
                    <td>{{ number_format($ligne['prix'], 2, ',', ' ') }} €</td>
                    <td>{{ number_format($ligne['total'], 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total HT : {{ number_format($totalHT, 2, ',', ' ') }} €</p>
    <p class="total">TVA (20%) : {{ number_format($tva, 2, ',', ' ') }} €</p>
    <p class="total">Total TTC : {{ number_format($totalTTC, 2, ',', ' ') }} €</p>

    @if($commentaires)
        <h3>Commentaires</h3>
        <p>{{ $commentaires }}</p>
    @endif
</body>
</html>
