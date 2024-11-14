<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;
use App\Models\Employee;

class AdminController extends Controller
{
    public function showListeClients()
    {
        if (session('role') !== 'admin') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        $clientAccounts = Client::all(); // Récupérer tous les clients
        $clients = [];
        $listeEmployees = Employee::pluck('employee_id');
        // Pour chaque client, récupérer les comptes associés
        foreach ($clientAccounts as $account) {
            $donnes = DB::table('accounts')
                ->where('account_id', $account->FK_account_id)
                ->first(); // Récupérer un seul compte
            
            // Ajouter les comptes du client dans le tableau $clients
            $clients[] = [
                'clientAccounts' => $account,
                'donneeClient' => $donnes
            ];
        }
        
        // Passer les clients à la vue
        return view('listeClients', ['clients' => $clients, 'listeEmployees' =>$listeEmployees]);
    }
}