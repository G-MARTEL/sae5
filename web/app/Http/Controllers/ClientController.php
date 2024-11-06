<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    // public function showClientDashboard()
    // {
    //     $clientData = session('clientData');
    //     return view('acceuilCliens', ['client' => $clientData]);
    // }

//     public function showClientDashboard()
// {
//     $clientData = session('clientData');
//     return view('acceuilCliens', ['clientData' => $clientData]);
// }

// public function showClientDashboard()
// {
//     $clientData = session('clientData');
    
//     // Vérifiez que les données existent avant de les utiliser
//     if (!$clientData) {
//         return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord !');
//     }
    
//     return view('acceuilCliens', ['clientData' => $clientData]);
// }

public function showClientDashboard()
{
    $clientData = session('clientData');
    
    // Vérifiez que les données existent avant de les utiliser
    if (!$clientData) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord !');
    }

    // Recharger les informations de l'employé associé au client
    $client = DB::table('clients')->where('FK_account_id', $clientData['account']->account_id)->first();
    $associatedEmployee = DB::table('employees')
        ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
        ->where('employee_id', $client->FK_employee_id)
        ->select('accounts.first_name', 'accounts.last_name', 'accounts.email','accounts.picture')
        ->first();

    $clientData['employee'] = $associatedEmployee;

    return view('acceuilCliens', ['clientData' => $clientData]);
}



}
