<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // Password dummy
            'role_id' => $this->faker->numberBetween(1, 2), // Contoh role_id antara 1-3
            'stripe_account_id' => $this->faker->optional()->regexify('acct_[0-9a-zA-Z]{16}'), // Opsional Stripe ID
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
