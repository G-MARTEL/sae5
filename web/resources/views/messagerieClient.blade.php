<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/messagerie/message.css') }}">
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

    <title>Messagerie</title>

</head>


<body>
    
    <div class="messaging-container">
        <a href="{{ route('client.accueil') }}">Retourner sur mon profil</a>
        {{-- <h1 class="messaging-title">Votre conversation</h1> --}}
        
        <!-- Fenêtre défilante pour les messages -->
        <div class="messages-scrollable">
            @foreach ($messages as $message)
            <div class="message my_message">
                <p class="message-sender">
                    {{ $message->Sender->first_name }} {{ $message->Sender->last_name }} 
                    {{-- <span> À :</span> {{ $message->Recipient->first_name }} {{ $message->Recipient->last_name }} --}}
                </p>
                <time class="message-time">{{ $message->creation_date }}</time>
                <p class="message-content">{{ $message->MessageContent->content }}</p>
            </div>
            @endforeach
        </div>

        <!-- Formulaire d'envoi de message -->
        {{-- <form class="message-form" action="sendMessage" method="post">
            @csrf
            <label class="form-label" for="message">Écrire un message :</label>
            <textarea class="form-textarea" name="message" id="message" placeholder="Votre message..."></textarea>
            <button class="form-button" type="submit">Envoyer</button>
        </form> --}}

        <form class="message-form">
            @csrf
            {{-- <label class="form-label" for="message">Écrire un message :</label> --}}
            <textarea class="form-textarea" name="message" id="message" placeholder="Votre message..."></textarea>
            <button class="form-button" type="submit">Envoyer</button>
        </form>
    </div>
</body>



<script>
    const currentUserId = {{ session('id') }};
    console.log(currentUserId);
    let previousMessagesLength = 0; 

   async function refreshMessages() {
    try {
        const response = await fetch('getmessage'); 
        if (!response.ok) {
            throw new Error('Erreur lors de la récupération des messages.');
        }

        const messages = await response.json(); 
        const messageContainer = document.querySelector('.messages-scrollable');
        messageContainer.innerHTML = ''; // Efface les messages existants


        messages.forEach(message => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message');

            if (message.FK_sender_id === currentUserId) {
                messageDiv.classList.add('my-message'); 
            }
            else{
                messageDiv.classList.add('received-message');
            }

            messageDiv.innerHTML = `
                <p class="message-sender">
                ${message.sender.first_name} ${message.sender.last_name}
                
                </p>
                <time class="message-time">${message.creation_date}</time>
                <p class="message-content">${message.message_content.content}</p>
                `;
            messageContainer.appendChild(messageDiv);
        });

        if (messages.length > previousMessagesLength) {
            scrollToBottom(); 
        }

        previousMessagesLength = messages.length;

        } catch (error) {
            console.error('Erreur:', error);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////
//rajouts 
document.addEventListener('DOMContentLoaded', () => {
    refreshMessages();
    scrollToBottom();
    document.querySelector('.message-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const messageContent = document.querySelector('#message').value;
       
        if (messageContent.trim() !== '') {
            sendMessage(messageContent).then(() => {
                document.querySelector('#message').value = ''; // Réinitialise le champ de message
                refreshMessages(); // Rafraîchit les messages après l'envoi
                //scrollToBottom(); // Scrolle vers le bas après l'envoi
            });
        }
    });
});

// Fonction pour envoyer le message via fetch 
async function sendMessage(message) {
    try {
        const response = await fetch('sendMessage', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('input[name="_token"]').value 
            },
            body: JSON.stringify({ message }) 
        });
        if (!response.ok) {
            throw new Error('Erreur lors de l\'envoi du message.');
        }
        const result = await response.json(); 
    } catch (error) {
        console.error('Erreur:', error);
    }

}

function scrollToBottom() {
    const messageContainer = document.querySelector('.messages-scrollable');
    messageContainer.scrollTop = messageContainer.scrollHeight;
}


    // Rafraîchir les messages toutes les 1 secondes
    setInterval(refreshMessages, 1000); 

</script>
</html>
