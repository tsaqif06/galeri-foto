<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'description' => '',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'username' => 'creator',
            'name' => 'Creator User',
            'email' => 'creator@gmail.com',
            'description' => 'Apa kabar',
            'role_id' => 2,
            'stripe_account_id' => 'acct_test_stripe',
        ]);

        User::factory()->create([
            'username' => 'buyer',
            'name' => 'Buyer User',
            'email' => 'buyer@gmail.com',
            'description' => 'Haloo',
            'role_id' => 2,
        ]);

        User::factory()->count(2)->create();
    }
}
