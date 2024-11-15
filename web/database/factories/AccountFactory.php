<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'postal_address' => $this->faker->address(),
            'code_address' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'picture' => $this->faker->imageUrl(200, 200, 'people', true, 'Faker'),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('12345'), // Crypte le mot de passe "12345"
            'creation_date' => now(),
        ];
    }
}
