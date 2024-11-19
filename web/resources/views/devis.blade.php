@extends('layout')

@section('styles')
@endsection


@section('scripts')

@endsection
@section('content')


    <div class="container" id="contact">
        <div class="container-inner">
            <div class="colonnes">
                <div class="colonne">
                    <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque 
                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.
                    </p>
                </div>   
                <div class="colonne">
                    <div class="contact-form">
                        <form action="devis" method="POST">
                        @csrf
                            <div class="colonnes">
                                <div class="colonne">
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="nom" id="nom" name="nom" placeholder="Doe" required>
                                    </div>
                                </div>
                                <div class="colonne">
                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input type="prenom" id="prenom" name="prenom" placeholder="John" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Mail</label>
                                <input type="email" id="email" name="email" placeholder="john.doe@mail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Numéro de téléphone</label>
                                <input type="tel" id="phone" name="phone" placeholder="06 XX XX XX XX" required>
                            </div>
                            <div class="form-group">
                                <label for="prestation">Prestation souhaitée</label>
                                <input type="text" id="prestation" name="prestation" placeholder="Accompagnement comptable" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="10" placeholder="Bonjour, je souhaiterais connaitre les différents types d'accompagments proposés pour les PME..." required></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div id="success-popup" class="popup">
                <div class="popup-content">
                    {{ session('success') }}
                </div>
            </div>
        @endif
    </div>


@endsection

<script src="{{asset('./js/scriptDevis.js')}}"></script>