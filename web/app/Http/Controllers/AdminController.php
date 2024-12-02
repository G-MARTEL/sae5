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


    public function showListeEmployee()
    {
        if (session('role')!== 'admin') {
            return redirect('/'); // Redirige si le rôle n'est pas 'admin'
        }
        // Récupérer tous les employés
        $listeEmployees = Employee::where('fk_function_id', '!=', 1)->get();

        $listeFunction =Functions::all();
        // Passer les employés à la vue
        return view('listeEmployee', ['listeEmployees' => $listeEmployees, 'listeFunction' => $listeFunction]);
    }

    public function creationEmployee(Request $request)
    {
        // Récupérer les entrées du formulaire ou de la requête
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $postal_address = $request->input('postal_address');
        $code_address = $request->input('code_address');
        $city = $request->input('city');
        $password = $request->input('password');
        $function_id = $request->input('function_id');

        // Créer un nouveau compte pour l'employé
        $account = new Account();
        $account->first_name = $first_name;
        $account->last_name = $last_name;
        $account->postal_address = $postal_address;
        $account->code_address = $code_address;
        $account->city = $city;
        $account->picture = null;
        $account->email = $email;
        $account->phone = $phone;
        $account->password =  Hash::make($password);
        $account->save();

        // Créer un nouvel employé avec le compte créé
        $employee = new Employee();
        $employee->FK_account_id = $account->account_id;
        $employee->FK_function_id = $function_id;
        $employee->save();

        return redirect()->back();
    }

    public function modifEmployee(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $funtions_id = $request->input('Funtions_id');

        $employee = Employee::where('employee_id', $employee_id)->first();
        $employee->FK_function_id=$funtions_id;
        $employee->save();

        return redirect()->back();

    }


    public function showListePrestations()
    {
        $listePresta= Services::all();
        return view('listePrestations', ['listePresta' => $listePresta]);
    }

    public function creationPrestation(Request $request)  
    {
        $titre = $request->input('titre');
        $description = $request->input('description');
        $situation = $request->input('situation');
        $advantage = $request->input('advantage');

        $prestation = new Services();
        $prestation->title = $titre;
        $prestation->description = $description;
        $prestation->advantage = $advantage;
        $prestation->situations = $situation;
        $prestation->save();

        return redirect()->back();

    }
}