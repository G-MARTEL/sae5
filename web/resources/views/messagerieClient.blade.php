<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .messages {
            width: 80%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .message {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .message:last-child {
            border-bottom: none;
        }
        .message h2 {
            font-size: 16px;
            margin: 5px 0;
            color: #333;
        }
        .message p {
            font-size: 14px;
            color: #555;
        }
        .message time {
            display: block;
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
        form {
            width: 80%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            resize: none;
            height: 100px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            float: right;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Messagerie Client</h1>

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
    <form action="sendMessage" method="post">
        @csrf
        <label for="message" style="display: block; margin-bottom: 10px;">Écrire un message :</label>
        <textarea name="message" id="message" placeholder="Votre message..."></textarea>
        <button type="submit">Envoyer</button>
    </form>
</body>

<script>
   async function refreshMessages() {
    try {
        const response = await fetch('getmessage'); // Assurez-vous que la route 'getmessage' est correcte
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
</html>
