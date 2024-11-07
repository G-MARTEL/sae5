<?php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\BDDController;
use App\Http\Controllers\Autentification;
use App\Http\Controllers\CreationCompte;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('accueil');
});

Route::get('acceuil', function () {return view('accueil');});

Route::get('qui-sommes-nous', function () {
    return view('presentation');
})->name('presentation');

Route::get('prestations', function () {
    return view('prestations');
})->name('prestations');


Route::get('prestation', function () {
    return view('prestation');
})->name('prestation');

Route::get('simulateur', function () {
  return view('simulateur');
})->name('simulateur') ;

Route::get('test', function () {
    return view('test');
  })->name('test') ;


Route::get('devis', function () {return view('devis');})->name('devis');




Route::get('/connexion', [Autentification::class, 'showLoginFormUser'])->name('login');
Route::post('/connexion', [Autentification::class, 'login']);

Route::get('/creationCompte',[CreationCompte::class, 'showFormCreationAccount'])->name('CreationCompte');
Route::post('/creationCompte',[CreationCompte::class, 'CreationAccount']);

Route::prefix('client')->name('client.')->group(function() {

    // Route::get('/accueil', function () {
    //     if (session('role') !== 'client') {
    //         return redirect('/'); // Redirige si le rôle n'est pas 'client'
    //     }
    //     return view('acceuilCliens');

    // })->name('accueil');
    Route::get('/accueil', [ClientController::class, 'showClientDashboard'])->name('accueil');


});



Route::prefix('employees')->name('employees.')->group(function() {
    Route::get('/accueil', function () {
        if (session('role') !== 'employee') {
            return redirect('/'); // Redirige si le rôle n'est pas 'employee'
        }
        return view('acceuilEmployees');
    })->name('accueil');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/accueil', function () {
        if (session('role') !== 'admin') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        return view('acceuilAdmin');
    })->name('accueil');
    Route::get('/listeClients', [AdminController::class, 'showListeClients']); 

});