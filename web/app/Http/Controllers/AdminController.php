<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showListeClients()
    {
        if (session('role') !== 'admin') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        $clientAccounts = DB::table('clients')->get(); // Récupérer tous les clients
        $clients = [];
        // Pour chaque client, récupérer les comptes associés
        foreach ($clientAccounts as $account) {
            $donnes = DB::table('accounts')
                ->where('account_id', $account->FK_account_id)
                ->get();
            
            // Ajouter les comptes du client dans le tableau $clients
            $clients[] = (object)[
                'clientAccounts' => $clientAccounts,
                'donnee' => $donnes
            ];
        }

        // Passer les clients à la vue
        return view('listeClients', ['clients' => $clients]);
    }
}