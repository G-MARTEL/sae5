<?php
namespace Database\Factories;

use App\Models\Account;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        // Générer un identifiant aléatoire de compte, en s'assurant qu'il n'est pas déjà utilisé par un employé.
        $account = Account::inRandomOrder()->first();  // Prendre un compte aléatoire existant dans la table accounts

        // Vérifier si l'account_id est déjà utilisé dans la table employees via fk_account_id
        while (Employee::where('fk_account_id', $account->account_id)->exists()) {
            // Si l'account_id est déjà utilisé dans employees, générer un autre compte
            $account = Account::inRandomOrder()->first();
        }

        // Retourner les données pour le client
        return [
            'FK_account_id' => $account->account_id,  // Assigner un account_id valide qui n'est pas utilisé par un employé
            'FK_employee_id' => null,  // Assigner un employee_id si nécessaire (ce champ peut être null si vous ne l'assignez pas)
            'client_id' => $this->faker->unique()->randomNumber(), // Générer un client_id unique
        ];
    }
}
