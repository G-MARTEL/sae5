<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('accueil');
})->name('home');

Route::get('Qui-Somme-Nous', function () {
    return view('prensentation');
});


use App\Http\Controllers\Autentification;

Route::get('/connexion', [Autentification::class, 'showLoginForm']);
Route::post('/connexion', [Autentification::class, 'login']);
