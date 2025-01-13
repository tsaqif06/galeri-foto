<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, $photoId)
    {
        $user = auth()->user();
        $photo = Photo::findOrFail($photoId);

        // Cek apakah sudah ada di favorit
        if ($user->favorites()->where('photo_id', $photoId)->exists()) {
            $user->favorites()->detach($photoId);
            return response()->json(['message' => 'Photo removed from favorites'], 200);
        } else {
            $user->favorites()->attach($photoId);
            return response()->json(['message' => 'Photo added to favorites'], 201);
        }
    }
}
