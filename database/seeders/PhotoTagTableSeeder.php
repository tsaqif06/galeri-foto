<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PhotoTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $photo = Photo::find(1);
        $tag = Tag::find(1);

        $photo->tags()->attach($tag->id_tag, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
