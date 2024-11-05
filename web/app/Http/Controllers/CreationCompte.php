<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;

class CreationCompte extends Controller
{
    public function showFormCreationAccount()
    {
        return view('creationCompte');
    }

    public function CreationAccount(Request $request){
        $account = DB::table('accounts')->where('email', $request->email)->first();
        $password = Hash::make($request->password);
        if (!$account) {
            DB::table('accounts')->insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'postal_address' => $request->postal_address,
                'code_address' => $request->code_address,
                'city' => $request->city,
                'email' => $request->email,
                'password' => $password, // Enregistre le mot de passe haché
                'creation_date' => $request->creation_date,
            ]);
            $idAccount = DB::table('accounts')
                ->orderBy('account_id', 'desc') // Remplacez `id` par la colonne qui convient dans votre table
                ->first()->account_id;
            DB::table('clients')->insert([
                'FK_account_id'=>$idAccount,
            ]);
            return redirect()->route('acceuil');
        } else {
            dd('Cet email est déjà utilisé');
        }
    }
}
