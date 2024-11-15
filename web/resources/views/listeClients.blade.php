<h1>liste clients</h1>

@foreach ($clients as $clientData)
    <p>  <strong>Nom et Prénom du client  :</strong> {{$clientData['donneeClient']->first_name.' '.$clientData['donneeClient']->last_name}}
       <br> <strong>Id : </strong>{{$clientData['clientAccounts']->client_id}}
    <form action="modifClientAsso" method="post">
        <input type="hidden" name="client_id" value="{{ $clientData['clientAccounts']->client_id }}">
        <Strong> Employer Associer :</Strong>
        @csrf
        <select name="employee_id" id="employee">
            @foreach ($listeEmployees as $Employer)
                <option value="{{ $Employer->employee_id }}" 
                    {{ $clientData['clientAccounts']->FK_employee_id == $Employer->employee_id ? 'selected' : '' }}>
                    {{ $Employer->account->first_name . ' ' . $Employer->account->last_name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Envoyer</button>
    </form>
    <br>
    </p>
@endforeach