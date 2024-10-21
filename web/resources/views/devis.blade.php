@extends('layout')

@section('styles')
@endsection


@section('scripts')
@endsection
@section('content')

    <div class="contact-container">
        <div class="contact-info">
            <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.
            </p>
        </div>
        <div class="contact-form">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="email">Mail</label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
                </div>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" required>
                </div>
                <div class="form-group">
                    <label for="prestation">Prestation souhaitée</label>
                    <input type="text" id="prestation" name="prestation" placeholder="Prestation souhaitée" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Envoyer</button>
            </form>
        </div>
    </div>


@endsection