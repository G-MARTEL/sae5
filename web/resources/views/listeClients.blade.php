<h1>liste clients</h1>

@foreach ($clients as $clientData)
    <p><strong>Client ID :</strong> {{ $clientData->donnee[account_id]}}</p>
@endforeach