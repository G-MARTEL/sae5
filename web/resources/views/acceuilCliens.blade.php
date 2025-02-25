@extends('layout')
<title>Votre profil</title>
@section('styles')
<link rel="stylesheet" href="{{ asset('/css/espace_client.css') }}"/>
@endsection


@section('scripts')
<script src="{{asset('./js/scriptAccueil.js')}}"defer></script>
@endsection
@section('content')



<div class="container">
    <div class="client-dashboard">
        <!-- Colonne principale -->
        <div class="main-content">
            <h2>Bienvenue, {{ $clientData['account']->first_name }} {{ $clientData['account']->last_name }}</h2>
            <ul>
                <li>Email : {{ $clientData['account']->email }}</li>
                <li>Téléphone : {{ $clientData['account']->phone }}</li>
                <li>Adresse : {{ $clientData['account']->postal_address }}, {{ $clientData['account']->code_address }} {{ $clientData['account']->city }}</li>
            </ul>

            <button id="openModalBtn" class="btn btn-primary">Gérer mes informations</button>

            <div class="contracts-section">
                @if($contrats->isNotEmpty())
                    <p>Mes contrats actifs :</p>
                    <ul>
                        @foreach ($contrats as $contrat)
                            <li>Numéro de contrat : {{ $contrat->numero_contract }}
                                <a href="{{ route('download.contract', $contrat->contract_id) }}" class="link-download">
                                    Télécharger le contrat
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Vous n'avez pas encore de contrat, contactez-nous vite !</p>
                @endif
            </div>


           

            <div class="documents-section">
                <h2>Mes documents</h2>
                @if($documents->isEmpty())
                    <p>Aucun document associé.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Détails</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                @foreach ($document->contentDocuments as $content)

                               <?php $texte = "$content->contenu" ;
                                $texteLimite = substr($texte, 0, 200);

                                if (strlen($texte) > 200) {
                                    $texteLimite .= '...';
                                } ?> 
                                    <tr>
                                        <td>{{ $document->facture ? 'Facture' : 'Autre' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($content->date)->format('d/m/Y') }}</td>
                                        <td><strong>{{ $content->title }} : </strong> <?php echo $texteLimite;
                    ?></td>
                                        <td>
                                            <a href="{{ route('download.document.client', ['id' => $document->createdocument_id]) }}" class="btn btn-primary">Télécharger</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- <h3>Ajouter un document</h3>
            <form method="POST" action="{{ route('client.upload.document') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="document" class="form-label">Déposer un document PDF</label>
                    <input type="file" class="form-control" id="document" name="document" accept="application/pdf" required>
                    <button type="submit" class="btn btn-primary">Déposer</button>
                </div>
            </form> --}}
        </div>

        
        

        <!-- Colonne secondaire -->
        @if (isset($clientData['employee']))
        <div class="advisor-info">
            <h3>Mon conseiller</h3>
            <img src="{{ asset($clientData['employee']->picture) }}" alt="{{$clientData['employee']->first_name}} {{ $clientData['employee']->last_name }} ">
            <p>{{ $clientData['employee']->first_name }} {{ $clientData['employee']->last_name }}</p>
            <p><a href="mailto:exemple@email.com">{{ $clientData['employee']->email }}</a></p>
            <p><a href="{{ route('client.messagerie') }}"><button class="btn btn-primary">Contacter {{ $clientData['employee']->first_name }}</button></a></p>

            <div class="upload-box">
                <p>Déposer un document PDF</p>
                <div class="drop-zone" id="dropZone">
                    <span>Glissez-déposez un fichier ici ou</span>
                    <input type="file" id="fileInput" accept="application/pdf" hidden>
                    <button type="button" id="chooseFileBtn">Choisir un fichier</button>
                    <p id="fileName">Aucun fichier sélectionné</p>
                </div>
                <button id="uploadBtn">Déposer</button>
            </div>
        </div>
        @endif

        
    </div>
</div>





<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier mes informations</h5>
            <button type="button" id="closeModalBtn" class="btn-close" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Formulaire pour la mise à jour des informations -->
            <form method="POST" action="{{ route('client.update') }}" >
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $clientData['account']->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $clientData['account']->phone }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $clientData['account']->postal_address }}">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $clientData['account']->city }}">
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>


@endsection
<script src="{{asset('./js/scriptPopUpClient.js')}}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Effet de fade-in progressif
    const sections = document.querySelectorAll('.main-content, .advisor-info');

    sections.forEach((section, index) => {
        setTimeout(() => {
            section.style.opacity = 1;
            section.style.transform = "translateY(0)";
        }, index * 200);
    });

    // Gestion de l'affichage du modal
    const modal = document.getElementById("editModal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");

    openModalBtn.addEventListener("click", function() {
        modal.classList.add("active");
    });

    closeModalBtn.addEventListener("click", function() {
        modal.classList.remove("active");
    });

    // Effet au survol des contrats
    const contractLinks = document.querySelectorAll('.contracts-section li');
    contractLinks.forEach(link => {
        link.addEventListener("mouseenter", () => {
            link.style.backgroundColor = "#e0ffe0";
        });
        link.addEventListener("mouseleave", () => {
            link.style.backgroundColor = "";
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("fileInput");
    const chooseFileBtn = document.getElementById("chooseFileBtn");
    const fileNameDisplay = document.getElementById("fileName");

    // Gestion du clic sur le bouton "Choisir un fichier"
    chooseFileBtn.addEventListener("click", () => fileInput.click());

    // Mise à jour du texte lorsqu'un fichier est sélectionné
    fileInput.addEventListener("change", () => {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        }
    });

    // Effet visuel pour le glisser-déposer
    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragging");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragging");
    });

    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragging");

        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            fileNameDisplay.textContent = e.dataTransfer.files[0].name;
        }
    });
});


</script>