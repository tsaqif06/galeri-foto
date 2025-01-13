<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $photoId)
    {
        $user = auth()->user();
        $photo = Photo::findOrFail($photoId);

        $like = Like::where('user_id', $user->id_user)->where('photo_id', $photoId)->first();

        if ($like) {
            $like->delete();

            $likesCount = Like::where('photo_id', $photoId)->count();

            return response()->json([
                'message' => 'Like removed',
                'likes_count' => $likesCount, // Kirim jumlah terbaru
            ], 200);
        } else {
            Like::create([
                'user_id' => $user->id_user,
                'photo_id' => $photoId,
            ]);

            $likesCount = Like::where('photo_id', $photoId)->count();

            return response()->json([
                'message' => 'Like added',
                'likes_count' => $likesCount, // Kirim jumlah terbaru
            ], 201);
        }
    }
}
