<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 1, // Role admin
        ]);

        User::factory()->create([
            'name' => 'Creator User',
            'email' => 'creator@example.com',
            'role_id' => 2, // Role creator
            'stripe_account_id' => 'acct_test_stripe', // Stripe ID
        ]);

        User::factory()->create([
            'name' => 'Buyer User',
            'email' => 'buyer@example.com',
            'role_id' => 2, // Role buyer
        ]);

        User::factory()->count(2)->create();
    }
}
