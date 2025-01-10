<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
use App\Models\Account;
use App\Models\Client;


class CreationCompte extends Controller
{
    public function showFormCreationAccount()
    {
        return view('creationCompte');
    }

    public function CreationAccount(Request $request){
        
        $account = Account::where('email', $request->email)->first();

        $password = Hash::make($request->password);//hachage du mdp
        if (!$account) {
            Account::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'postal_address' => $request->postal_address,
                'code_address' => $request->code_address,
                'city' => $request->city,
                'email' => $request->email,
                'password' => $password, 
                //'creation_date' => $request->creation_date,
                'creation_date' => now(),

            ]);

            /*$idAccount = DB::table('accounts')
                ->orderBy('account_id', 'desc') 
                ->first()->account_id;

            DB::table('clients')->insert([
                'FK_account_id'=>$idAccount,
            ]);*/
            // sans utiliser le model 

            $idAccount = Account::orderBy('account_id', 'desc')->first()->account_id;

            Client::create(['FK_account_id' => $idAccount,]); // avec le model


            return redirect('acceuil');
        } else {
            dd('Cet email est déjà utilisé');
        }
    }
}
