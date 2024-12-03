<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Functions;
use App\Models\Services;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function showListeClients()
    {
        if (session('role') !== 'employee') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        $clientAccounts = Client::all(); // Récupérer tous les clients
        $clients = [];
        foreach ($clientAccounts as $account) {
            $donnes = Account::where('account_id', $account->FK_account_id)
                ->first(); 
            
            // Ajouter les comptes du client dans le tableau $clients
            $clients[] = [
                'clientAccounts' => $account,
                'donneeClient' => $donnes
            ];
        }

        $services = Services::all(); 

        // Passer les clients à la vue
        return view('creerContrats', ['clients' => $clients, 'services' => $services]);
    }

    public function creationContrat(Request $request){
        
    }


}