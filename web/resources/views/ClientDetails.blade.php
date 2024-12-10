<h1>Informations sur le client</h1>

<p><strong>Nom :</strong> {{ $client->account->last_name }}</p>
<p><strong>Prénom :</strong> {{ $client->account->first_name }}</p>
<p><strong>Email :</strong> {{ $client->account->email }}</p>
<p><strong>Téléphone :</strong> {{ $client->account->phone }}</p>
<p><strong>Adresse postale :</strong> {{ $client->account->postal_address }}</p>
<p><strong>Code postal :</strong> {{ $client->account->code_address }}</p>
<p><strong>Ville :</strong> {{ $client->account->city }}</p>
<p><strong>Date de création :</strong> {{ $client->account->creation_date }}</p>

<h2>Contrats souscrits</h2>
<table>
    <thead>
        <tr>
            <th>Numéro de contrat</th>
            <th>Type de prestation</th>
            <th>Date de création</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @if($client->contracts->isEmpty())
            <tr>
                <td colspan="4">Aucun contrat souscrit.</td>
            </tr>
        @else
            @foreach($client->contracts as $contract)
                <tr>
                    <td>{{ $contract->numero_contract }}</td>
                    <td>{{ $contract->service->title }}</td> <!-- Assurez-vous que le service est chargé si vous avez besoin de plus d'informations -->
                    <td>{{ $contract->creation_date }}</td>
                    <td>{{ $contract->is_active ? 'Actif' : 'Inactif' }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<form action="{{ route('employees.creationContrat') }}" method="POST">
    @csrf
    <input type="hidden" name="client_id" value="{{ $client->client_id }}">
    
    <label for="prestation">Type de prestation :</label>
    <select name="prestation_id" required>
        @foreach ($services as $service)
            <option value="{{ $service->service_id }}">{{ $service->title }}</option>
        @endforeach
    </select>
    
    <button type="submit">Créer contrat</button>
</form>



{{-- <a href="/employees/listeClientAttitres">Retour à la liste des clients</a> --}}

<a href="{{ route('employees.listeClientAttitres') }}">Retour à la liste des clients</a>
