<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat - 15615151515</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1, h2 {
            text-align: center;
        }
        .content {
            margin: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }

        p {
            margin-top:5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/pdf/placeholder.jpg') }}" alt="Logo de l'entreprise">
    <h1>Contrat n°1565651515</h1>
    <h2>Détails du contrat</h2>
    <div class="content">
        <div class="section">
            <p class="section-title">Informations sur le client :</p>
            <p>Nom : Hugo Duboisset </p>
        </div>

        <div class="section">
            <p class="section-title">Informations sur l'employé associé :</p>
            <p>Nom :Quentin massoulle</p>
            <p>Email : massoullecity@mail.com</p>
            <p>Téléphone : 06265656565</p>
        </div>

        <div class="section">
            <p class="section-title">Informations sur la prestation :</p>
            <p>Nom de la prestation : optimisation fiscale</p>
        </div>

        <div class="section">
            <p class="section-title">Détails du contrat :</p>
            <table>
                <tr>
                    <th>Date de création</th>
                    <td>12/09/1998</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>actif</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
