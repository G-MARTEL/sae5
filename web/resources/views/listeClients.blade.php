<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}"/>
        <title>Gestion des clients</title>
     </head>
<body>
    
<div class="containeur">
    <div class="container-inner">
        <h1>Nos clients</h1>
    </div>
    
</div>

<div class="list-section">
    <div class="grid-container">
        @foreach ($clients as $clientData)
            <div class="grid-item"> 
                <div class="content">
                    <div class="details">
                        <p><strong>Nom et Prénom du client :</strong> {{$clientData['donneeClient']->first_name.' '.$clientData['donneeClient']->last_name}}</p>
                <p><strong>Id :</strong> {{$clientData['clientAccounts']->client_id}}</p>

                <form action="modifClientAsso" method="post">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $clientData['clientAccounts']->client_id }}">

                    <strong>Son conseiller :</strong>
                    <select name="employee_id" id="employee">
                        @php
                        if ($clientData['clientAccounts']->FK_employee_id == null) {
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
                    </div>
                </div>
                
            </div>
        @endforeach
    </div>
</div>

</body>