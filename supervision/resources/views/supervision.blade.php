<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="titre"><h1>Supervision</h1></div>
    
    <div class="toolbar">
        <input type="text" placeholder="Rechercher..." class="search-bar">
        <button class="filter-btn"><img src="{{ asset('img/icone/filtre.png') }}" alt="Icone de filtre"></button>
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
            @foreach ($devices as $device)
                <tr>
                    <td class="titleTableau">{{ $device->FK_machine_id }}</td>
                    <td class="{{ $device->ping ? 'status-ok' : 'status-error' }}">{{ $device->ping ? 'oui' : 'non' }}</td>
                    <td class="{{ $device->storage >= 90 ? 'status-warning' : '' }}">{{ $device->storage }}/500Go</td>
                    <td class="{{ $device->ram >= 90 ? 'status-warning' : '' }}">{{ $device->ram }}%</td>
                    <td>{{ $device->cpu }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
