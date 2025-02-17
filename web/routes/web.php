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
use App\Http\Controllers\DocumentController;

use App\Http\Controllers\MessageriControlleur;

use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\PrestationsController;
use App\Http\Controllers\PretImmobilierController;


Route::get('/', function () {
    if (session('role') == 'admin') {
        return redirect()->route('admin.accueil');
    } elseif (session('role') == 'employee') {
        return redirect()->route('employees.accueil');
    } elseif (session('role') == 'client') {
        return redirect()->route('client.accueil');
    }
    return view('accueil'); // Si aucun rôle n'est défini, afficher la vue d'accueil par défaut
})->name('accueil');

Route::fallback(function () {
    return redirect('/');
});


Route::get('/video-call/{room}', function ($room) {
    return view('call', ['room' => $room]);
})->name('video-call');


Route::get('/start-call', function () {
    $room = uniqid();
    Session::put("room_$room", true); // Stocke temporairement la salle
    return redirect()->route('video-call', ['room' => $room]);
});


Route::get('/accueil2', function () {
    return view('accueil');
})->name('accueil2');

Route::get('/planning', function () {
    return view('planning');
})->name('planning');

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

//Route::get('/prestation', [PrestationsController::class, 'showPrestations'])->name('prestations');


Route::get('/connexion', [Autentification::class, 'showLoginFormUser'])->name('login');
Route::post('/connexion', [Autentification::class, 'login']);

Route::get('/creationCompte',[CreationCompte::class, 'showFormCreationAccount'])->name('CreationCompte');
Route::post('/creationCompte',[CreationCompte::class, 'CreationAccount']);

Route::prefix('client')->name('client.')->group(function() {
    Route::get('/accueil', [ClientController::class, 'showClientDashboard'])->name('accueil');
    Route::post('/update', [ClientController::class, 'updateClientInfo'])->name('update');
    Route::get('/messagerie', [MessageriControlleur::class, 'showMessagerie'])->name('messagerie');
    Route::post('/sendMessage', [MessageriControlleur::class, 'sendMessageClient']);
    Route::get('/getmessage', [MessageriControlleur::class, 'getMessages'])->name('getMessages');
    
});
Route::get('/download-contract/{contractId}', [ClientController::class, 'downloadContract'])->name('download.contract');





Route::prefix('employees')->name('employees.')->group(function() {

    Route::get('/accueil', function () {return view('acceuilEmployees');})->name('accueil');
    Route::get('/conversation', [MessageriControlleur::class, 'showConversationEmployee']);
    Route::get('/conversation/{id}', [MessageriControlleur::class, 'showConversation']);
    Route::post('sendMessage', [MessageriControlleur::class, 'sendMessageEmployee']);
    // Route::get('creerContrats', [EmployeeController::class, 'showListeClients']);
    Route::post('/creationContrat', [EmployeeController::class, 'creationContrat'])->name('creationContrat');
    Route::get('listeClientAttitres', [EmployeeController::class, 'listeClientAttitres'])->name('listeClientAttitres');
    Route::get('clients/{id}', [EmployeeController::class, 'showClient'])->name('clients.show');
    Route::get('getmessageEmployee/{id}', [MessageriControlleur::class, 'getmessageEmployee']);

    Route::get('/notifications', [EmployeeController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/{id}/markAsSeen', [EmployeeController::class, 'markAsSeen'])->name('notifications.markAsSeen');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/accueil', function () {return view('acceuilAdmin');})->name('accueil');
    Route::get('/listeClients', [AdminController::class, 'showListeClients']);
    Route::post('/modifClientAsso', [AdminController::class, 'modifClientAsso']);
    Route::get('/listeEmployee', [AdminController::class, 'showListeEmployee']);
    Route::post('/creationEmployee', [AdminController::class, 'creationEmployee']);
    Route::post('/modifEmployee', [AdminController::class, 'modifEmployee']);
    Route::get('/listePrestations', [AdminController::class, 'showlistePrestations']);
    Route::post('/creationPrestation', [AdminController::class, 'creationPrestation']); 
    Route::post('/modifPrestation', [AdminController::class, 'updatePrestation'])->name('modifPrestation');
    Route::get('/getEmployeesForService/{service_id}', [AdminController::class, 'getEmployeesForService']);
    Route::post('/updateEmployees', [AdminController::class, 'updateEmployees']);
    Route::post('/disableEmployees', [AdminController::class, 'disableEmployees']);


});


Route::get('/logout', function () {
    Session::flush(); 
    return redirect('/'); 
})->name('logout');



Route::get('/simulateur-pret', [PretImmobilierController::class, 'index'])->name('simulateur-pret-form');
Route::post('/simulateur-pret', [PretImmobilierController::class, 'simulateImmo'])->name('simulateImmo');


Route::post('/client/upload-document', [ClientController::class, 'uploadDocument'])->name('client.upload.document');
Route::get('/documents/download/{id}', [EmployeeController::class, 'download'])->name('download.document');
Route::post('/documents/store', [EmployeeController::class, 'store'])->name('documents.store');

Route::get('/documents/downloadDocument/{id}', [DocumentController::class, 'downloadDocument'])->name('documents.downloadDocument');



Route::get('/client/download-document/{id}', [DocumentController::class, 'downloadDocumentClient'])->name('download.document.client');


