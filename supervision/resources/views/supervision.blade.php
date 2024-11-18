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
                @php
                    // Conditions pour le stockage
                    $storagePercentage = ($device->storage / $device->max_storage) * 100;

                    // Définir les classes
                    $pingClass = $device->ping ? 'status-ok' : 'status-error';
                    $storageClass = $storagePercentage >= 95 ? 'status-error' : ($storagePercentage >= 80 ? 'status-warning' : '');
                    $ramClass = $device->ram >= 100 ? 'status-error' : ($device->ram >= 90 ? 'status-warning' : '');
                    $cpuClass = $device->cpu >= 100 ? 'status-error' : ($device->cpu >= 90 ? 'status-warning' : '');
                @endphp
                <tr>
                    <td class="titleTableau">{{ $device->machine_name }}</td>
                    <td class="{{ $pingClass }}">{{ $device->ping ? 'oui' : 'non' }}</td>
                    <td class="{{ $storageClass }}">{{ $device->storage }}/{{ $device->max_storage }}Go</td>
                    <td class="{{ $ramClass }}">{{ $device->ram }}%</td>
                    <td class="{{ $cpuClass }}">{{ $device->cpu }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
