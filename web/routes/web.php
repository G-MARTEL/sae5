<?php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\BDDController;
use App\Http\Controllers\Autentification;
use App\Http\Controllers\CreationCompte;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PrestationsController;
use App\Http\Controllers\PretImmobilierController;


Route::get('/', function () {
    return view('accueil');
});

Route::get('acceuil', function () {return view('accueil');});

Route::get('qui-sommes-nous', function () {
    return view('presentation');
})->name('presentation');


Route::get('simulateur', function () {
  return view('simulateur/simulateur');
})->name('simulateur') ;

Route::get('test', function () {
    return view('test');
  })->name('test') ;


Route::get('devis', function () {return view('devis');})->name('devis');
Route::post('/devis', [DevisController::class, 'store']);


Route::get('/prestations', [PrestationsController::class, 'showPrestations'])->name('prestations');
Route::get('/prestation/{id}', [PrestationsController::class,'show'])->name('prestation.show');

Route::get('/prestation', [PrestationsController::class, 'showPrestations'])->name('prestations');


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
Route::get('/download-contract/{contractId}', [ClientController::class, 'downloadContract'])->name('download.contract');


Route::post('/client/update', [ClientController::class, 'updateClientInfo'])->name('client.update');


Route::prefix('employees')->name('employees.')->group(function() {
    Route::get('/accueil', function () {
        if (session('role') !== 'employee') {
            return redirect('/'); // Redirige si le rôle n'est pas 'employee'
        }
        return view('acceuilEmployees');
    })->name('accueil');
    Route::get('creerContrats', [EmployeeController::class, 'showListeClients']);
    Route::post('/creationContrat', [EmployeeController::class, 'creationContrat']);
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/accueil', function () {
        if (session('role') !== 'admin') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        return view('acceuilAdmin');
    })->name('accueil');
    Route::get('/listeClients', [AdminController::class, 'showListeClients']);
    Route::post('/modifClientAsso', [AdminController::class, 'modifClientAsso']);
    Route::get('/listeEmployee', [AdminController::class, 'showListeEmployee']);
    Route::post('/creationEmployee', [AdminController::class, 'creationEmployee']);
    Route::post('/modifEmployee', [AdminController::class, 'modifEmployee']);
    Route::get('/listePrestations', [AdminController::class, 'showlistePrestations']);
    Route::post('/creationPrestation', [AdminController::class, 'creationPrestation']); 

});


Route::get('/logout', function () {
    Session::flush(); 
    return redirect('/'); 
})->name('logout');



Route::get('/simulateur-pret', [PretImmobilierController::class, 'index'])->name('simulateur-pret-form');
Route::post('/simulateur-pret', [PretImmobilierController::class, 'simulate'])->name('simulateur-pret');


