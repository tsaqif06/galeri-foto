<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil beberapa user dan foto
        $users = User::take(5)->get();
        $photos = Photo::take(5)->get();

        foreach ($users as $user) {
            foreach ($photos as $photo) {
                Like::create([
                    'user_id' => $user->id_user,
                    'photo_id' => $photo->id_photo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
