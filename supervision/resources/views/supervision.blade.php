<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="titre"><h1>Supervision</h1></div>
    
    <div class="toolbar">
        <input type="text" placeholder="Rechercher..." class="search-bar">
            <button class="filter-btn"><img src="../img/icone/filtre.png" alt="Icone de filtre"></button>
            <button class="status-btn active">Etat global</button>
            <button class="status-btn">Etat critique</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Ping</th>
                <th>Stockage</th>
                <th>RAM</th>
                <th>CPU</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="titleTableau">PC1</td>
                <td>oui</td>
                <td>10,9/500Go</td>
                <td>60%</td>
                <td>80%</td>
            </tr>
            <tr>
                <td class="titleTableau">PC2</td>
                <td class="status-error">non</td>
                <td>11,8/500Go</td>
                <td>70%</td>
                <td>70%</td>
            </tr>
            <tr>
                <td class="titleTableau">PC3</td>
                <td>oui</td>
                <td class="status-warning">415,8/500Go</td>
                <td class="status-warning">90%</td>
                <td>60%</td>
            </tr>
            <tr>
                <td class="titleTableau">PC4</td>
                <td>oui</td>
                <td class="status-error">480,9/500Go</td>
                <td>30%</td>
                <td>45%</td>
            </tr>
            <tr>
                <td class="titleTableau">DNS</td>
                <td>oui</td>
                <td>6,8/500Go</td>
                <td>10%</td>
                <td>58%</td>
            </tr>
            <tr>
                <td class="titleTableau">BDD</td>
                <td>oui</td>
                <td>264,4/500Go</td>
                <td class="status-error">99%</td>
                <td>85%</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
