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
                <td>{{ $client->account->last_name }}</td>
                <td>{{ $client->account->first_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
