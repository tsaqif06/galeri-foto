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
            'uuid' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'uuid' => (string) Str::uuid(),
            'name' => 'Creator User',
            'email' => 'creator@gmail.com',
            'role_id' => 2,
            'stripe_account_id' => 'acct_test_stripe',
        ]);

        User::factory()->create([
            'uuid' => (string) Str::uuid(),
            'name' => 'Buyer User',
            'email' => 'buyer@gmail.com',
            'role_id' => 2,
        ]);

        User::factory()->count(2)->create();
    }
}
