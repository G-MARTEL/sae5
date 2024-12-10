<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>
                    <a href="{{ route('employees.clients.show', $client->client_id) }}">
                        {{ $client->account->last_name }}
                    </a>
                </td>
                <td>{{ $client->account->first_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
