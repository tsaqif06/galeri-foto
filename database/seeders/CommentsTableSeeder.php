<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil beberapa user dan foto
        $users = User::take(5)->get();
        $photos = Photo::take(5)->get();

        foreach ($photos as $photo) {
            foreach ($users as $user) {
                Comment::create([
                    'user_id' => $user->id_user,
                    'photo_id' => $photo->id_photo,
                    'comment' => "This is a dummy comment from user {$user->id} on photo {$photo->id}.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
