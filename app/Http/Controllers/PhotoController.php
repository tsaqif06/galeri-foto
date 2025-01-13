<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Tag;

class PhotoController extends Controller
{
    public function index()
    {
        $recentPhotos = Photo::latest()->limit(6)->get();
        $popularPhotos = Photo::orderBy('views', 'desc')->limit(6)->get();
        $categories = Tag::with('photos')->get();

        return view('home.index', compact('recentPhotos', 'popularPhotos', 'categories'));
    }

    public function show($slug, Request $request)
    {
        // Ambil data foto dengan relasi user, likes, comments, dan favorites
        $photo = Photo::with(['user', 'likes', 'comments', 'favorites'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Validasi visibilitas foto (hanya pemilik yang boleh lihat jika private)
        if ($photo->visibility === 'private') {
            $user = $this->isApiRequest($request) ? auth('api')->user() : auth()->user();

            if (!$user || $user->id_user !== $photo->user_id) {
                if ($this->isApiRequest($request)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to view this photo.'
                    ], 403);
                }

                abort(403, 'You do not have permission to view this photo.');
            }
        }

        // Hitung total likes, apakah user menyukai foto, dan apakah disimpan user
        $user = auth()->user();
        $isLiked = $user ? $photo->likes->contains('user_id', $user->id_user) : false;
        $isSaved = $user ? $photo->favorites->contains('user_id', $user->id_user) : false;

        // Tambahkan view counter
        $photo->increment('views');

        // Jika API request, kirim data dalam bentuk JSON
        if ($this->isApiRequest($request)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'photo' => $photo,
                    'user' => $photo->user,
                    'likes_count' => $photo->likes->count(),
                    'comments' => $photo->comments,
                    'is_liked' => $isLiked,
                    'is_saved' => $isSaved,
                ],
            ], 200);
        }

        // Render view untuk web
        return view('photo.show', compact('photo', 'isLiked', 'isSaved'));
    }
}
