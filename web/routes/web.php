<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('accueil');
})->name('home');

use App\Http\Controllers\Autentification;

Route::get('/connexion', [Autentification::class, 'showLoginForm']);
Route::post('/connexion', [Autentification::class, 'login']);
