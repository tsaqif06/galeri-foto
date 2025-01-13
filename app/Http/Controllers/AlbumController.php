<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class AlbumController extends Controller
{
    public function createAlbum(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album = Album::create([
            'user_id' => auth()->user()->id_user,
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Album created', 'album' => $album], 201);
    }

    public function updateAlbum(Request $request, $albumId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album = Album::findOrFail($albumId);

        if ($album->user_id != auth()->user()->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $album->update(['name' => $request->name]);

        return response()->json(['message' => 'Album updated', 'album' => $album], 200);
    }

    public function deleteAlbum($albumId)
    {
        $album = Album::findOrFail($albumId);

        if ($album->user_id != auth()->user()->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $album->delete();

        return response()->json(['message' => 'Album deleted'], 200);
    }

    public function addPhotoToAlbum(Request $request, $albumId)
    {
        $album = Album::findOrFail($albumId);

        if ($album->user_id != auth()->user()->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $photoId = $request->photo_id;
        $album->photos()->attach($photoId);

        return response()->json(['message' => 'Photo added to album'], 201);
    }
}
