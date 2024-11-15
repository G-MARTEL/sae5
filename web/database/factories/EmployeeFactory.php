<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Employee;
use App\Models\Functions; // Ajoutez cette ligne si vous avez une table "functions"
use App\Models\Client;  // Importer le modèle Client
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        // Générer un FK_function_id à partir des fonctions existantes (si vous avez une table "functions")
        $function = Functions::inRandomOrder()->first(); // Récupère une fonction existante aléatoirement

        // Générer un FK_account_id à partir des comptes existants
        // Exclure les comptes déjà associés à un client
        $account = Account::inRandomOrder()->first();

        // Si le compte est déjà utilisé par un client, chercher un autre compte
        while (Client::where('FK_account_id', $account->account_id)->exists() || Employee::where('FK_account_id', $account->account_id)->exists()) {
            $account = Account::inRandomOrder()->first();  // Sélectionner un autre compte aléatoire
        }
        

        return [
            'FK_function_id' => $function->function_id,  // Assigner une fonction valide
            'FK_account_id' => $account->account_id,    // Assigner un compte valide
        ];
    }
}
