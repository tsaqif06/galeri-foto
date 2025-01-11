<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    public function run()
    {
        Photo::factory()->count(10)->create();
    }
}
