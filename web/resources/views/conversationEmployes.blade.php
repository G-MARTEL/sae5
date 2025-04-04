<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/messagerie/message.css') }}">
    <link rel="icon" href="{{ asset("assets\communs\logo_avycompta.png") }}" type="image/png">

    <title>Conversation Employés</title>
</head>
<body>
    </a>
    <div class="messaging-container">
    <a href="{{ route('employees.accueil') }}">Retourner à votre espace employé</a>
    <a href="{{ route('employees.accueil') }}">Activer l'appel vidéo</a>
    <!-- Liste des messages -->
        <div class="messages-scrollable">
            @foreach ($messages as $message)
            <div class="message">
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
        <form action="/employees/sendMessage" method="post" class="message-form">
            @csrf
            {{-- <label class="form-label" for="message">Écrire un message :</label> --}}
            <textarea class="form-textarea" name="message"  placeholder="Votre message..."></textarea>
            <input type="hidden" name="id" value="{{ $id }}"> 
            <button class="form-button" type="submit">Envoyer</button>
        </form>
    </div>
</body>
    <script>
        const id = {{ $id }};
        console.log(id);

        const currentUserId = {{ session('id') }};
        console.log(currentUserId);

        let previousMessagesLength = 0;

        async function refreshMessages() {
         try {
            const response = await fetch(`/employees/getmessageEmployee/${id}`);
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




         ////////////////////////////////////////////////////////////////////////
         /// rajouts 

        document.addEventListener('DOMContentLoaded', () => {
        // Écouteur d'événements pour le formulaire d'envoi de message
        document.querySelector('.message-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche le rechargement de la page

            const messageContent = document.querySelector('.form-textarea').value; 
            const id = document.querySelector('input[name="id"]').value; 

            // Vérifiez si le message n'est pas vide
            if (messageContent.trim() !== '') {
                sendMessage(id, messageContent).then(() => {
                    document.querySelector('.form-textarea').value = ''; // Réinitialise le champ de message
                    refreshMessages(); 
                    scrollToBottom(); 
                });
            }
        })

        });

        // Fonction pour envoyer le message via fetch
        async function sendMessage(id, message) {
            try {
                const response = await fetch('/employees/sendMessage', { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('input[name="_token"]').value 
                    },
                    body: JSON.stringify({ id, message }) 
                });
                if (!response.ok) {
                    throw new Error('Erreur lors de l\'envoi du message.');
                }
                const result = await response.json(); 
                console.log(result); 
            } catch (error) {
                console.error('Erreur:', error);
            }
        }


         function scrollToBottom() {
            const messageContainer = document.querySelector('.messages-scrollable');
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
            
         setInterval(refreshMessages, 1000); 
     
     </script>
</body>
</html>
