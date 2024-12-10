<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document - {{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            width: 100px; 
            height: auto; 
        }
        h1, h2 {
            text-align: center;
        }
        .content {
            margin: 20px;
        }
        .section {
            margin-bottom: 25px;
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
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .company-contact {
            text-align: right;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>{{ $title }}</h1>
        </div>
        <div class="company-contact">
            <p>AvyCompta</p>
            <p>70 avenue Paul Claudel, 80000 Amiens</p>
            <p>0612345678</p>
            <p>contact@avycompta.com</p>
        </div>
    </div>
    <div class="content">
        <div class="section">
            <p class="section-title">Souscripteur :</p>
            <p>{{ $client_name }}</p>
            <p>{{ $client_email }}</p>
            <p>{{ $client_phone }}</p>
        </div>

        <div class="section">
            <p class="section-title">Votre conseiller :</p>
            <p>{{ $employee_name }}</p>
            <p>{{ $employee_function }}</p>
            <p>{{ $employee_email }}</p>
            <p>{{ $employee_phone }}</p>
        </div>

        <div class="section">
            <p class="section-title">Type :</p>
            <p>{{ $type }}</p>
        </div>
        
        <div class="section">
            <p class="section-title">Date :</p>
            <p>{{ $date }}</p>
        </div>

        <div class="section">
            {{-- <p class="section-title">Contenu :</p> --}}
            <p>{{ $content }}</p>
        </div>
        
    </div>
</body>
</html>
