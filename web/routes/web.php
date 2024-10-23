<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\BDDController;
use App\Http\Controllers\Autentification;

Route::get('/', function () {
    return view('accueil');
})->name('home');

Route::get('Qui-Somme-Nous', function () {return view('prensentation');})->name('presentation');

Route::get('prestation', function () {return view('prestation');})->name('prestation');


Route::get('simulateur', function () {return view('simulateur');})->name('simulateur');


Route::get('devis', function () {return view('devis');})->name('devis');




Route::prefix('user')->name('user.')->group(function () {
    Route::get('/connexion', [Autentification::class, 'showLoginForm'])->name('login');
    Route::post('/connexion', [Autentification::class, 'login']);
});

