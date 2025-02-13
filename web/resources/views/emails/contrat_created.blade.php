{{-- <!DOCTYPE html>
<html>
<head>
    <title>Nouveau Document</title>
</head>
<body>
    <p>Bonjour {{ $clientName }},</p>
    <p>Un nouveau document intitulé <strong>{{ $documentTitle }}</strong> a été ajouté à votre espace.</p>
    <p>Connectez-vous pour le consulter.</p>
    <p>Cordialement,</p>
    <p>Votre expert-comptable</p>
</body>
</html>
 --}}


 <!DOCTYPE html>
 <html>
 <head>
     <style>
         /* Styles inlinés recommandés */
         .container {
             width: 100%;
             max-width: 600px;
             margin: auto;
             font-family: Arial, sans-serif;
         }
         .header {
             background-color: #2c7d7b;
             color: white;
             padding: 15px;
             text-align: center;
             font-size: 20px;
         }
         .content {
             padding: 20px;
             font-size: 16px;
             line-height: 1.5;
         }
         
     </style>
 </head>
 <body>
     <div class="container">
         <div class="header">
             Un nouveau contrat a été ajouté à votre profil
         </div>
         <div class="content">
             Bonjour {{ $clientName }},<br><br>
             La souscription à notre offre <strong>{{ $contratTitle }}</strong> a été confirmée, un nouveau contrat a été édité.
             Contrat numéro <strong>{{ $contractNumber }}</strong> <br><br> 
             <p>Connectez-vous pour en savoir plus.</p>
             <p>Cordialement,</p>
             <p>Votre expert-comptable</p>
             <br><br>
         </div>
     </div>
 </body>
 </html>
 