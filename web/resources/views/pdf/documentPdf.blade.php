<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .details {
            margin-top: 20px;
        }
        .details th, .details td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .details th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="content">
        <p><strong>Type :</strong> {{ $type }}</p>
        <p><strong>Date :</strong> {{ $date }}</p>
        <div class="details">
            <p><strong>Contenu :</strong></p>
            <p>{{ $content }}</p>
        </div>
    </div>
</body>
</html>
