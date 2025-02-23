<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre devis</title>
</head>
<body>
    <p>Bonjour {{ $devis->first_name }},</p>
    <p>Vous trouverez ci-joint votre devis concernant votre demande de service : <strong>{{ $devis->type_of_service }}</strong>.</p>
    <p>Si vous avez des questions, n’hésitez pas à nous contacter.</p>
    <p>Cordialement,</p>
    <p>L'équipe</p>
</body>
</html>
