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
        $photo = Photo::with('user')->where('slug', $slug)->firstOrFail();

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

        if ($this->isApiRequest($request)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'photo' => $photo,
                    'user' => $photo->user,
                ],
            ], 200);
        }

        return view('photo.show', compact('photo'));
    }
}
