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
        $listeEmployees = Employee::all();
        foreach ($clientAccounts as $account) {
            $donnes = Account::where('account_id', $account->FK_account_id)
                ->first(); 
            
            // Ajouter les comptes du client dans le tableau $clients
            $clients[] = [
                'clientAccounts' => $account,
                'donneeClient' => $donnes
            ];
        }
        
        // Passer les clients à la vue
        return view('listeClients', ['clients' => $clients, 'listeEmployees' =>$listeEmployees]);
    }

    public function modifClientAsso(Request $request)
    {
        // Récupérer les entrées du formulaire ou de la requête
        $employee_id = $request->input('employee_id');
        $clients_id = $request->input('client_id');

        // Trouver le client en fonction du client_id
        $client = Client::where('client_id', $clients_id)->first();
        // Vérifier si le client existe
        if (!$client) {
            // Retourner une erreur si le client n'existe pas
            return redirect()->back()->with('error', 'Client non trouvé');
        }

        // Modifier le FK_employee_id du client avec le nouvel employee_id
        $client->FK_employee_id = $employee_id;
        // Sauvegarder les changements dans la base de données
        $client->save();

        return redirect()->back();
    }
}