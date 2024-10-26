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

    public function login(Request $request)
    {
        $mdp =$request -> password;
        $email = $request -> email;
        $account = DB::table('accounts')->where('email', $request->email)->first();
        if ($account && $mdp === $account->password) // a modifier avec if ($account && Hash::check($mdp, $account->password)) il s'agit d'un hachage laravel
        {
            
            $employees = DB::table('employees')->where('FK_account_id',$account ->account_id)->first();
            if ($employees)
            {
                Session::put('role', 'employee');
                Session::put('id', $employees->FK_account_id);
                return redirect('/employees/accueil');
            }
            $clien = DB::table('client')->where('FK_account_id',$account ->account_id)->first();
            Session::put('role', 'client');
            Session::put('id', $clien->FK_account_id);
            return redirect('/client/accueil');
        }
        else{
            return redirect()->back()->with('error', 'Veuillez vérifier vos identifiants !')->withInput(); //
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
                dd(session);
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
