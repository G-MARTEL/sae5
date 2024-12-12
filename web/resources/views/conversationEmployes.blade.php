<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation Employés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .messages {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            max-width: 800px;
        }
        .message {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .message:last-child {
            border-bottom: none;
        }
        .message h2, .message p, .message time {
            margin: 5px 0;
        }
        form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
        }
        textarea {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
            height: 100px;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Conversation avec le client</h1>

    <!-- Liste des messages -->
    <div class="messages">
        @foreach ($messages as $message)
        <div class="message">
            <h2><strong>De :</strong> {{ $message->Sender->first_name }} {{ $message->Sender->last_name }}</h2>
            <h2><strong>À :</strong> {{ $message->Recipient->first_name }} {{ $message->Recipient->last_name }}</h2>
            <time>{{ $message->creation_date }}</time>
            <p>{{ $message->MessageContent->content }}</p>
        </div>
        @endforeach
    </div>
    
    <!-- Formulaire d'envoi de message -->
    <form action="/employees/sendMessage" method="post">
        @csrf
        <textarea name="message" placeholder="Votre message..."></textarea>
        <input type="hidden" name="id" value="{{ $id }}"> 
        <button type="submit">Envoyer</button>
    </form>

    <script>
        const id = {{ $id }};
        console.log(id);
        async function refreshMessages() {
         try {
            const response = await fetch(`/employees/getmessageEmployee/${id}`);
             // Assurez-vous que la route 'getmessage' est correcte
             if (!response.ok) {
                 throw new Error('Erreur lors de la récupération des messages.');
             }
             const messages = await response.json(); // Les messages renvoyés doivent être au format JSON
             const messageContainer = document.querySelector('.messages');
             messageContainer.innerHTML = ''; // Efface les messages existants
             messages.forEach(message => {
                 const messageDiv = document.createElement('div');
                 messageDiv.classList.add('message');
                 messageDiv.innerHTML = `
                     <h2><strong>De :</strong> ${message.sender.first_name} ${message.sender.last_name}</h2>
                     <h2><strong>À :</strong> ${message.recipient.first_name} ${message.recipient.last_name}</h2>
                     <time>${message.creation_date}</time>
                     <p>${message.message_content.content}</p>
                 `;
                 messageContainer.appendChild(messageDiv);
             });
             } catch (error) {
                 console.error('Erreur:', error);
             }
         }
     
         // Rafraîchir les messages toutes les 10 secondes
         setInterval(refreshMessages, 1000); // Intervalle de 10 secondes pour éviter une surcharge du serveur
     
     </script>
</body>
</html>
