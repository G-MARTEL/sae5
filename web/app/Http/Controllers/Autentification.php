<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class Autentification extends Controller
{
    public function showLoginForm()
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
            if ($employees){
                $admin=DB::table('functions')->where('function_id',$employees->FK_function_id)->first();
                if ($admin){
                    echo 'Admin';
                }
                else{
                    echo 'employees';
                }
            }
            else{echo 'utilisateur';}
        }
        return view('FormConnexion');
        
    }
}
