<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => 'Nature', 'created_at' => now(), 'updated_at' => now()]);
        Tag::create(['name' => 'Technology', 'created_at' => now(), 'updated_at' => now()]);
        Tag::create(['name' => 'Animals', 'created_at' => now(), 'updated_at' => now()]);
    }
}
