<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/Connexion', function () {
    return view('FormConnexion');
});