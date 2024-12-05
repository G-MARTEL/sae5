<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un PDF</title>
</head>
<body>
    <h1>Créer un PDF</h1>
    <form action="{{ route('pdf.generate') }}" method="POST">
        @csrf
        <label for="title">Titre du document :</label><br>
        <input type="text" name="title" id="title" required><br><br>

        <label for="content">Contenu :</label><br>
        <textarea name="content" id="content" rows="5" required></textarea><br><br>

        <button type="submit">Générer le PDF</button>
    </form>
</body>
</html>





