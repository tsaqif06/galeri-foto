<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class UserTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $tags = Tag::all();

        foreach ($users as $user) {
            $randomTags = $tags->random(rand(1, 3));

            foreach ($randomTags as $tag) {
                DB::table('tbl_user_tag')->insert([
                    'user_id' => $user->id_user,
                    'tag_id' => $tag->id_tag,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
