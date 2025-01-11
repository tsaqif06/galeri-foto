<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Administrator of the platform',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Role::create([
            'name' => 'user',
            'description' => 'User',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
