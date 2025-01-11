<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Functions;
use App\Models\Services;
use App\Models\TeamServices;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showListeClients()
    {
        if (session('role') != 'admin')
        {
            Session::flush(); 
            return redirect('/');
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
        if (session('role') != 'admin')
        {
            Session::flush(); 
            return redirect('/');
        }
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

        if (session('role') != 'admin')
        {
            Session::flush(); 
            return redirect('/');
        }
        // Récupérer tous les employés
        $listeEmployees = Employee::where('fk_function_id', '!=', 1)
            ->orWhereNull('fk_function_id')
            ->get();

        $listeFunction =Functions::all();
        // Passer les employés à la vue
        return view('listeEmployee', ['listeEmployees' => $listeEmployees, 'listeFunction' => $listeFunction]);
    }

    public function creationEmployee(Request $request)
    {
        if (session('role') != 'admin')
        {
            Session::flush(); 
            return redirect('/');
        }
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

        $imagePath = null;
         if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Utilisez simplement le nom de fichier sans le chemin
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = 'assets/employees/' . $imageName;

        // Déplacez l'image dans le dossier public
        $request->file('image')->move(public_path('assets/employees'), $imageName);
    }

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
        $account->picture = $imagePath;
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
        if (session('role') != 'admin')
        {
            Session::flush(); 
            return redirect('/');
        }
        $employee_id = $request->input('employee_id');
        $funtions_id = $request->input('Funtions_id');

        $employee = Employee::where('employee_id', $employee_id)->first();
        $employee->FK_function_id=$funtions_id;
        $employee->save();

        return redirect()->back();

    }


    public function showListePrestations()
    {
        if (session('role') != 'admin') {
            Session::flush(); 
            return redirect('/');
        }
        $listePresta = Services::all();
        $listeEmployees = Employee::all();
        return view('listePrestations', ['listePresta' => $listePresta, 'listeEmployees' => $listeEmployees]);
    }
    
    public function getEmployeesForService($service_id)
    {
        // Charger les employés et leurs comptes associés
        $employees = Employee::with('account')
            ->get();
    
        // Récupérer les employés assignés
        $assignedEmployees = TeamServices::where('FK_service_id', $service_id)
            ->pluck('FK_employee_id')
            ->toArray();
        
        return response()->json([
            'assignedEmployees' => $assignedEmployees,
            'employees' => $employees,  // Vous renvoyez les employés avec la relation 'account'
        ]);
    }
    

    ////a modif 
    public function updateEmployees(Request $request)
    {
        $serviceId = $request->input('service_id');
        $employeeIds = $request->input('employee_ids', []);  // Cela récupérera correctement les employés sélectionnés

        
        // Supprimer les anciens employés affectés
        TeamServices::where('FK_service_id', $serviceId)->delete();
        
        // Vérifier si des employés ont été sélectionnés
        if (!empty($employeeIds)) {
            // Ajouter les nouveaux employés affectés
            foreach ($employeeIds as $employeeId) {
                TeamServices::create([
                    'FK_service_id' => $serviceId,
                    'FK_employee_id' => $employeeId
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Les employés ont été mis à jour.');
    }
    
    

    public function creationPrestation(Request $request)  
    {
        if (session('role') != 'admin')
        {
            return redirect('/');
        }
        $titre = $request->input('titre');
        $description = $request->input('description');
        $situation = $request->input('situation');
        $advantage = $request->input('advantage');


        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = 'assets/services/' . $request->file('image')->getClientOriginalName();
            
            $request->file('image')->move(public_path('assets/services'), $imagePath);
        }
        
        $prestation = new Services();
        $prestation->title = $titre;
        $prestation->description = $description;
        $prestation->advantage = $advantage;
        $prestation->situations = $situation;
        $prestation->picture = $imagePath;
        $prestation->save();

        return redirect()->back();

    }


    public function updatePrestation(Request $request)
    {
        if (session('role') != 'admin') {
            return redirect('/');
        }

        $prestation = Services::findOrFail($request->input('service_id'));
        $prestation->title = $request->input('titre');
        $prestation->description = $request->input('description');
        $prestation->advantage = $request->input('advantage');
        $prestation->situations = $request->input('situation');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = 'assets/services/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/services'), $imagePath);
            $prestation->picture = $imagePath;
        }

        $prestation->save();

        return redirect()->back()->with('success', 'Prestation modifiée avec succès.');
    }

    function disableEmployees(Request $request)
    {
        $idEmployes = $request->idEmployees;
        $employee = Employee::where('employee_id', $idEmployes)->first();
        $employee->isActif = false;
        $employee->save();
        
        Client::where('FK_employee_id', $idEmployes)->update(['FK_employee_id' => NULL]);

        return redirect()->back();
    }





}