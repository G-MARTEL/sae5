<h1>liste clients</h1>

@foreach ($clients as $clientData)
    <p><strong>compte ID :</strong> {{$clientData['donneeClient']->account_id }} 
    <br> <strong>Client ID :</strong> {{$clientData['clientAccounts']->client_id}}
    <br> <Strong> Employer id Associer :</Strong> 
    <select>
        <option value="" selected>{{$clientData['clientAccounts']->FK_employee_id}}</option> 
        @foreach ( $listeEmployees as $Employer )
            <option value="{{$Employer }}">{{ $Employer }}</option>
        @endforeach
    </select></p>
@endforeach