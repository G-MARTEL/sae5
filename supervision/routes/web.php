<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisionController;

// Route pour afficher la supervision
Route::get('/', [SupervisionController::class, 'showSupervision'])->name('supervision');

// Route pour récupérer les dispositifs
Route::get('/devices', [SupervisionController::class, 'getDevices'])->name('getDevices');

// Route de redirection vers /graphique/1
Route::get('/graphique', function () {
    return redirect('/graphique/1'); // Redirige vers la machine avec ID 1
});

// Route pour afficher les graphiques d'une machine spécifique
Route::get('/graphique/{machineId}', [SupervisionController::class, 'showGraphique']);

// Route pour récupérer les données de la machine via l'API
Route::get('/api/get_machine_data', [SupervisionController::class, 'getMachineData'])->name('api.get_machine_data');
