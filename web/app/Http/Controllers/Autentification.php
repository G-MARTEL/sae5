<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Functions;


use Illuminate\Http\Request;

class Autentification extends Controller
{
    // public function showLoginFormUser()
    // {
    //     return view('FormConnexion'); // Assure-toi que la vue existe
    // }

    // // Auth guard, simplifie la gestion des utilisateurs  
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ], [
    //         'email.required' => 'Veuillez fournir votre adresse email.',
    //         'email.email' => 'L\'adresse email doit être valide.',
    //         'password.required' => 'Le mot de passe est obligatoire.',
    //     ]);


    //     $mdp =$request -> password;
    //     $email = $request -> email;
    //     $account = DB::table('accounts')->where('email', $request->email)->first();
    //     if ($account && Hash::check($mdp, $account->password)) 
    //     {
            
    //         $employees = DB::table('employees')->where('FK_account_id',$account ->account_id)->first();
    //         $func=Functions::where('function_id',$employees->FK_function_id)->first();
    //         if ($employees)
    //         {
    //             $func=Functions::where('function_id',$employees->FK_function_id)->first();
    //             if ($func->function_name=="Admin"){
    //                 session(['role' => 'admin',
    //                         'id' => $employees->FK_account_id
    //                     ]);
    //                 return redirect('admin/accueil');
    //             }
    //             Session::put('role', 'employee');
    //             Session::put('id', $employees->FK_account_id);
    //             return redirect('/employees/accueil');
    //         }
    //       $client = DB::table('clients')->where('FK_account_id', $account->account_id)->first();
    //       if ($client) {
    //           // Récupération de l'employé associé au client
    //           $associatedEmployee = DB::table('employees')
    //               ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
    //               ->where('employee_id', $client->FK_employee_id)
    //               ->select('accounts.first_name', 'accounts.last_name', 'accounts.email', 'accounts.picture')
    //               ->first();

    //           // Stockage des informations dans la session
    //           Session::put('role', 'client');
    //           Session::put('id', $client->FK_account_id);
    //           Session::put('clientData', [
    //               'account' => $account,
    //               'employee' => $associatedEmployee // Stockage des données de l'employé ici
    //           ]);

    //           return redirect()->route('client.accueil');
    //       }
    //       return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants!')->withInput();
    //     }
    //     else 
    //     {
    //         return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput();
    //     }
    // }

    public function showLoginFormUser()
    {
        return view('FormConnexion'); // Assure-toi que la vue existe
    }

    // Auth guard, simplifie la gestion des utilisateurs  
    public function login(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Veuillez fournir votre adresse email.',
            'email.email' => 'L\'adresse email doit être valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Vérification de l'existence de l'email dans la table des comptes
        $account = DB::table('accounts')->where('email', $email)->first();

        if ($account && Hash::check($password, $account->password)) {
            // Vérification s'il s'agit d'un employé
            $employee = DB::table('employees')->where('FK_account_id', $account->account_id)->first();
            if ($employee) {
                // Récupération de la fonction de l'employé
                $function = Functions::where('function_id', $employee->FK_function_id)->first();
                if ($function) {
                    Session::put('role', $function->function_name);
                    Session::put('id', $employee->FK_account_id);
                    // Redirection en fonction du rôle
                    return redirect($function->function_name === "Admin" ? 'admin/accueil' : '/employees/accueil');
                }
            }

            // Vérification s'il s'agit d'un client
            $client = DB::table('clients')->where('FK_account_id', $account->account_id)->first();
            if ($client) {
                // Récupération de l'employé associé au client
                $associatedEmployee = DB::table('employees')
                    ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
                    ->where('employee_id', $client->FK_employee_id)
                    ->select('accounts.first_name', 'accounts.last_name', 'accounts.email', 'accounts.picture')
                    ->first();

                // Stockage des informations dans la session
                Session::put('role', 'client');
                Session::put('id', $client->FK_account_id);
                Session::put('clientData', [
                    'account' => $account,
                    'employee' => $associatedEmployee // Stockage des données de l'employé ici
                ]);

                return redirect()->route('client.accueil');
            }
            
            // Si l'utilisateur n'est ni un employé ni un client
            return redirect()->back()->with('error', 'Aucun compte associé à cet email.')->withInput();
        }

        // Erreur d'authentification
        return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput();
    }

    public function logout()
{
    Session::flush(); 
    return redirect('/'); 
}
}
