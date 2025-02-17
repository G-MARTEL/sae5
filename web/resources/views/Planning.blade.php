<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre rendez-vous</title>
    <link rel="stylesheet" href="css/planning.css">
</head>
<body>
    <div class="Cadre_title">
        <h1 class="title_planning">Prendre rendez-vous</h1>
    </div>

    <div class="container">
        <!-- Tableau des créneaux de disponibilité -->
        <table class="planning_table">
            <thead>
                <tr>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="slot">1H <br> 8h-9h</div>
                        <div class="slot">1H <br> 14h-15h</div>
                    </td>
                    <td>
                        <div class="slot">1H <br> 8h-9h</div>
                    </td>
                    <td></td>
                    <td>
                        <div class="slot">2H <br> 8h-10h</div>
                    </td>
                    <td>
                        <div class="slot">1H <br> 8h-9h</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Formulaire pour la raison du rendez-vous -->
        <div class="appointment_form">
            <h2>Raison du rendez-vous</h2>

            <label for="reason"><b>Choisir un thème :<b></label>
            <select id="reason" name="reason" required>
                <option value="" selected disabled>Choisissez le thème</option>
                <option value="1">Création d'entreprise</option>
                <option value="2">Fiscalité & Déclarations</option>
                <option value="3">Gestion de la paie</option>
                <option value="4">Audit et comptabilité</option>
                <option value="5">Optimisation fiscale</option>
                <option value="6">Bilan et clôture annuelle</option>
                <option value="7">Autre</option>
            </select>

            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="5" placeholder="Décrivez votre besoin en détail..."></textarea>

            <button class="btn_appointment">Prendre rendez-vous</button>
        </div>
    </div>
</body>
</html>
