<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class Autentification extends Controller
{
    public function showLoginFormUser()
    {
        return view('FormConnexion'); // Assure-toi que la vue existe
    }


    public function showLoginFormAdmin()
    {
        return view('FormConnexion'); // Assure-toi que la vue existe
    }


//     public function login(Request $request)
// {
//     $mdp = $request->password;
//     $email = $request->email;

//     $account = DB::table('accounts')->where('email', $email)->first();

//     if ($account && $mdp === $account->password) {
//         $employees = DB::table('employees')->where('FK_account_id', $account->account_id)->first();
//         if ($employees) {
//             Session::put('role', 'employee');
//             Session::put('id', $employees->FK_account_id);
//             return redirect('/employees/accueil');
//         }

//         $client = DB::table('clients')->where('FK_account_id', $account->account_id)->first();
//         if ($client) {
//             Session::put('role', 'client');
//             Session::put('client_id', $client->client_id);
//             return redirect()->route('client.accueil')->with('clientData', $account);
//         }
//     } else {
//         return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput();
//     }
// }


// public function login(Request $request)
// {
//     $mdp = $request->password;
//     $email = $request->email;

//     $account = DB::table('accounts')->where('email', $email)->first();

//     if ($account && $mdp === $account->password) {

//         $employee = DB::table('employees')->where('FK_account_id', $account->account_id)->first();
//         if ($employee) {
//             Session::put('role', 'employee');
//             Session::put('id', $employee->FK_account_id);
//             return redirect('/employees/accueil');
//         }

//         $client = DB::table('clients')->where('FK_account_id', $account->account_id)->first();
//         if ($client) {
//             $associatedEmployee = DB::table('employees')
//                 ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
//                 ->where('employees.employee_id', $client->FK_employee_id)
//                 ->select('accounts.first_name', 'accounts.last_name', 'accounts.email')
//                 ->first();

//             $clientData = [
//                 'account' => $account,
//                 'client' => $client,
//                 'employee' => $associatedEmployee
//             ];

//             Session::put('role', 'client');
//             Session::put('id', $client->FK_account_id);
//             Session::put('clientData', $clientData);

//             return redirect()->route('client.accueil')->with('clientData', $clientData);
//         }
        
//     } else {
//         return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput();
//     }
// }

public function login(Request $request)
{
    $mdp = $request->password;
    $email = $request->email;

    $account = DB::table('accounts')->where('email', $email)->first();

    if ($account && $mdp === $account->password) {

        // Vérification si c'est un employé
        $employee = DB::table('employees')->where('FK_account_id', $account->account_id)->first();
        if ($employee) {
            Session::put('role', 'employee');
            Session::put('id', $employee->FK_account_id);
            return redirect('/employees/accueil');
        }

        // Vérification si c'est un client
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
    } else {
        return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput();
    }
}





    public function loginAdmin(Request $request)
    {
        $mdp =$request -> password;
        $email = $request -> email;
        $account = DB::table('accounts')->where('email', $request->email)->first();
        $employees = DB::table('employees')->where('FK_account_id',$account ->account_id)->first();
        if ($employees && $mdp === $account->password) // a modifier avec if ($account && Hash::check($mdp, $account->password)) il s'agit d'un hachage laravel
        {
        $admin=DB::table('functions')->where('function_id',$employees->FK_function_id)->first();
            if ($admin){
                session(['role' => 'admin',
                        'id' => $employees->FK_account_id
                    ]);
                return redirect('admin/acceuil');
            }
            else{
                return redirect()->back()->with('error', "Seci n'est pas un compte admin!")->withInput(); 
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput(); //
        }
     
    }
}
