<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $recentPhotos = Photo::latest()->limit(6)->get();
        $popularPhotos = Photo::orderBy('views', 'desc')->limit(6)->get();
        $categories = Tag::with('photos')->get();

        return view('home.index', compact('recentPhotos', 'popularPhotos', 'categories'));
    }
}
