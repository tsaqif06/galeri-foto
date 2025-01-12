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
