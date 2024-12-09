<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Functions;
use App\Models\Services;
use App\Models\Contract;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function showListeClients()
    {
        if (session('role') !== 'employee') {
            Session::flush(); 
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
        if (session('role') !== 'employee') {
            Session::flush(); 
            return redirect('/'); // Redirige si le rôle n'est pas 'employee'
        }
    
        $clientId = $request->input('client_id'); 
        $serviceId = $request->input('prestation_id'); 
        $employeeId = session('id'); 
        $employee = Employee::where('FK_account_id', $employeeId)->first();
        $idEmployee = $employee ? $employee->employee_id : null;
        // Génération d'un numéro de contrat
        
        $contractCount = Contract::count() + 1;

        $date = now()->format('dmY');

        $contractNumber = $contractCount . $clientId . $idEmployee . $serviceId . $date;
    
        // Création du contrat
        $newContract = Contract::create([
            'numero_contract' => $contractNumber,
            'FK_service_id' => $serviceId,
            'FK_client_id' => $clientId,
            'FK_employee_id' => $idEmployee,
            'creation_date' => now(),
            'is_active' => true,
        ]);
    
        return redirect()->back();
    }


}