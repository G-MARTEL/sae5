liste de vos conversation 

@foreach ($conversations as $conversation)
    <div>
        <strong> id de la conversation :</strong> {{ $conversation->conversation_id}}<br/>
        <strong>id du client : </strong> {{ $conversation->client->Account->first_name}}<br/>
        <strong>id du client : </strong> {{ $conversation->client->Account->last_name}}<br/>
        <strong>etat : </strong> {{ $conversation->is_active? 'ouvert' : 'fermé' }}<br/>
    </div>
    <a href="conversation/{{ $conversation->conversation_id}}">acceder a la conv</a>
@endforeach