<h1>liste clients</h1>

@foreach ($clients as $clientData)
    <p><strong>compte ID :</strong> {{$clientData['donnee']->account_id }} <br> <strong>Client ID :</strong> {{$clientData['clientAccounts']->client_id}}</p>
@endforeach