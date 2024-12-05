@extends('layout')

@section('content')
<div class="container">
    <h1>Simulateurs</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pret-tab" data-toggle="tab" href="#pret" role="tab" aria-controls="pret" aria-selected="true">Simulateur de Prêt Immobilier</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="impot-tab" data-toggle="tab" href="#impot" role="tab" aria-controls="impot" aria-selected="false">Simulateur d'Impôt sur le Revenu</a>
        </li>
        <!-- Ajoutez d'autres simulateurs ici -->
    </ul>
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pret" role="tabpanel" aria-labelledby="pret-tab">
            <h2>Simulation de Prêt Immobilier</h2>
            <form action="{{ route('simulateur-pret') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="capital">Montant emprunté (€) :</label>
                    <input type="number" name="capital" id="capital" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="taux">Taux d’intérêt annuel (%) :</label>
                    <input type="number" name="taux" id="taux" class="form-control" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="duree">Durée du prêt (en années) :</label>
                    <input type="number" name="duree" id="duree" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="apport">Apport personnel (€) :</label>
                    <input type="number" name="apport" id="apport" class="form-control">
                </div>
                <div class="form-group">
                    <label for="assurance">Assurance emprunteur (% annuel) :</label>
                    <input type="number" name="assurance" id="assurance" class="form-control" step="0.01">
                </div>
                <button type="submit" class="btn btn-primary">Simuler</button>
            </form>
        </div>

        <div class="tab-pane fade" id="impot" role="tabpanel" aria-labelledby="impot-tab">
            <h2>Simulation de Prêt Immobilier</h2>
            <form action="{{ route('simulateur-pret') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="capital">Montant emprunté (€) :</label>
                    <input type="number" name="capital" id="capital" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="taux">Taux d’intérêt annuel (%) :</label>
                    <input type="number" name="taux" id="taux" class="form-control" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="duree">Durée du prêt (en années) :</label>
                    <input type="number" name="duree" id="duree" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="apport">Apport personnel (€) :</label>
                    <input type="number" name="apport" id="apport" class="form-control">
                </div>
                <div class="form-group">
                    <label for="assurance">Assurance emprunteur (% annuel) :</label>
                    <input type="number" name="assurance" id="assurance" class="form-control" step="0.01">
                </div>
                <button type="submit" class="btn btn-primary">Simuler</button>
            </form>
        </div>

        <!-- Ajoutez d'autres simulateurs ici -->
    </div>
</div>

<!-- Inclure jQuery et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
@endsection


