<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/listeEmployee.css') }}">


    <script src="{{asset('./js/pop-up.js')}}"></script>
</head>


<button id="open-popup-btn">Créer un nouvel utilisateur</button>

<!-- Popup -->
<div id="pop-up" class="popup">
    <div class="popup-content">
        <span id="close-popup-btn" class="close-btn">&times;</span>
        <h2>Créer un nouvel Employee</h2>
        <form id="creationEmployee" action="creationEmployee" method="POST">
            @csrf 
            <label for="first_name">Prénom:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">Nom:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="phone">phone:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="postal_address">postal_address:</label>
            <input type="postal_address" id="postal_address" name="postal_address" required>

            <label for="code_address">code_address:</label>
            <input type="code_address" id="code_address" name="code_address" required>

            <label for="city">city:</label>
            <input type="city" id="city" name="city" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>


            <label for="function">Fonction de l'employe:</label>
            <select name="function_id" id="Functions">
                @foreach($listeFunction as $Functions)
                    <option value="{{ $Functions->function_id}}" 
                        {{ $Functions->function_id ? 'selected' : '' }}>
                        {{ $Functions->function_name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit">Créer</button>
        </form>
    </div>
</div>

@foreach ($listeEmployees as $employee)

    <p> Nom : {{$employee->Account->last_name}} ,
        Prenom : {{$employee->Account->first_name}}, 
        <form action="modifEmployee" method="post">
        @csrf
        <input type="hidden" name="employee_id" value="{{$employee->employee_id}}">
        <select name="Funtions_id" id="Functions">
        @foreach($listeFunction as $Functions)
            <option value="{{ $Functions->function_id}}" 
                {{ $employee->FK_function_id == $Functions->function_id ? 'selected' : '' }}>
                {{ $Functions->function_name }}
            </option>
        @endforeach
        </select>
        <button type="submit" class="envoyee">Envoyer</button>
    </form>
    </p>
@endforeach
