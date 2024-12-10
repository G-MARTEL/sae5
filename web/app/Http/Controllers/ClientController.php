<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Functions;
use App\Models\Documents;

use Dompdf\Dompdf;
use Dompdf\Options;


class ClientController extends Controller
{


// public function showClientDashboard()
// {
//     $clientData = session('clientData');
    
//     // Vérifiez que les données existent avant de les utiliser
//     if (!$clientData) {
//         return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord !');
//     }

//     // Recharger les informations de l'employé associé au client
//     $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();


//     $associatedEmployee = DB::table('employees')
//         ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
//         ->where('employee_id', $client->FK_employee_id)
//         ->select('accounts.first_name', 'accounts.last_name', 'accounts.email','accounts.picture')
//         ->first();

//     $clientData['employee'] = $associatedEmployee;

//     return view('acceuilCliens', ['clientData' => $clientData]);
// }


public function showClientDashboard()
{
    if (session('role') != 'client')
    {
        Session::flush(); 
        return redirect('/');
    }

    $clientData = session('clientData');

    // Vérifiez que les données existent avant de les utiliser
    if (!$clientData) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord !');
    }

    // Récupérer le client à partir de l'account_id
    $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();

    // Vérifiez que le client a été trouvé
    if (!$client) {
        return redirect()->route('login')->with('error', 'Client non trouvé !');
    }

    // Récupérer les contrats associés au client
    $contrats = Contract::where('FK_client_id', $client->client_id)->get(); 

    // Déboguer pour vérifier les données
    //dd($client, $contrats);

    // Rechercher l'employé associé au client
    $associatedEmployee = DB::table('employees')
        ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
        ->where('employee_id', $client->FK_employee_id)
        ->select('accounts.first_name', 'accounts.last_name', 'accounts.email', 'accounts.picture')
        ->first();

    // Ajouter les données de l'employé aux données du client
    $clientData['employee'] = $associatedEmployee;

    // Retourner la vue avec les données du client et les contrats
    return view('acceuilCliens', ['clientData' => $clientData, 'contrats' => $contrats]);
}


public function updateClientInfo(Request $request)
{
    if (session('role') != 'client')
    {
        Session::flush(); 
        return redirect('/');
    }
    
    // Valider les données du formulaire
    $request->validate([
        'email' => 'required|email',
        'phone' => 'required|string|min:10|max:10',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
    ]);

    // Récupérer les données du client depuis la session
    $clientData = session('clientData');
    $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();

    // Mettre à jour les informations dans la table 'accounts'
    DB::table('accounts')->where('account_id', $clientData['account']->account_id)->update([
        'email' => $request['email'],
        'phone' => $request['phone'],
        'postal_address' => $request['address'],
        'city' => $request['city'],
    ]);

    // Mettre à jour les données de session
    $clientData['account']->email = $request['email'];
    $clientData['account']->phone = $request['phone'];
    $clientData['account']->postal_address = $request['address'];
    $clientData['account']->city = $request['city'];

    // Sauvegarder les nouvelles informations dans la session
    session(['clientData' => $clientData]);

    $contrats = Contract::where('FK_client_id', $client->client_id)->get();


    return view('acceuilCliens', ['clientData' => $clientData, 'contrats' => $contrats]);
}


public function downloadContract($contractId)
{
    
    // Récupérer les données du client depuis la session
    $clientData = session('clientData');

    // Vérifiez que les données existent avant de les utiliser
    if (!$clientData) {
        Session::flush(); 
        return redirect('/');
    }

    // Récupérer le client à partir de l'account_id
    $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();

    

    // Charger le contrat avec ses relations nécessaires
    $contract = Contract::with(['client', 'employee.account', 'service', 'employee.functions'])
        ->findOrFail($contractId);

    // Vérifiez que le contrat appartient bien au client
    if ($contract->FK_client_id !== $client->client_id) {
        return redirect('/');
    }

    // Créer les données pour le PDF
    $data = [
        'numero_contract' => $contract->numero_contract,
        'client_name' => $contract->client->account->first_name . ' ' . $contract->client->account->last_name,
        'employee_name' => $contract->employee->account->first_name . ' ' . $contract->employee->account->last_name,
        'employee_email' => $contract->employee->account->email,
        'client_email' => $contract->client->account->email,
        'employee_function' => $contract->employee->functions->function_name,
        'employee_phone' => $contract->employee->account->phone,
        'client_phone' => $contract->client->account->phone,
        'service_name' => $contract->service->title,
        'creation_date' => $contract->creation_date,
        'is_active' => $contract->is_active ? 'Actif' : 'Inactif',
    ];

    $pdf = Pdf::loadView('pdf.contractPdf', $data);
    return $pdf->download('Contrat_'.$contract->numero_contract.'.pdf');
}


public function uploadDocument(Request $request)
{
    // Validation des données
    $validator = Validator::make($request->all(), [
        'document' => 'required|file|mimes:pdf|max:2048', // Limite à 2MB et uniquement les PDF
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Récupérer les données du client depuis la session
    $clientData = session('clientData');
    $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();

    if (!$client) {
        return redirect()->route('login')->with('error', 'Client non trouvé !');
    }

    // Lire le contenu du fichier
    $file = $request->file('document');
    $fileContent = file_get_contents($file);

    // Sauvegarder dans la base de données
    Documents::create([
        'FK_client_id' => $client->client_id,
        'document' => $fileContent,
        'date' => now(),
    ]);

    return redirect()->back()->with('success', 'Document déposé avec succès !');
}

public function employee()
{
    return $this->belongsTo(Employee::class, 'FK_employee_id', 'employee_id');

}



}
