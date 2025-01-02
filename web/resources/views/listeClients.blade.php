<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/listeClient.css') }}"/>
        <title>Gestion des clients</title>
     </head>
<body>
    
<div class="containeur">
    <div class="container-inner">
        <h1>Nos clients</h1>
    </div>
    
</div>

<div class="containeur">
    <div class="container-inner">
        @foreach ($clients as $clientData)
        <p>  <strong>Nom et Prénom du client  :</strong> {{$clientData['donneeClient']->first_name.' '.$clientData['donneeClient']->last_name}}
        <br> <strong>Id : </strong>{{$clientData['clientAccounts']->client_id}}

        <form action="modifClientAsso" method="post">
            @csrf
            <input type="hidden" name="client_id" value="{{ $clientData['clientAccounts']->client_id }}">

            <Strong> Son conseiller :</Strong>

            <select name="employee_id" id="employee">
                @php
                if ($clientData['clientAccounts']->FK_employee_id == null)
                {
                    echo '<option value="">Aucun employé associé</option>';
                }
                @endphp
                
                @foreach ($listeEmployees as $Employer)
                    <option value="{{ $Employer->employee_id }}" 
                        {{ $clientData['clientAccounts']->FK_employee_id == $Employer->employee_id ? 'selected' : '' }}>
                        {{ $Employer->account->first_name . ' ' . $Employer->account->last_name }}
                    </option>
                @endforeach

            </select>
            <button type="submit">Associer</button>

        </form>
        <br>
        </p>
        @endforeach
    </div>
</div>



</body>