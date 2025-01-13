<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($username, Request $request)
    {
        $user = User::where('username', $username)->firstOrFail();

        $photos = Photo::when(auth()->check(), function ($query) use ($user) {
            if (auth()->user()->id_user === $user->id_user) {
                return $query->where('user_id', $user->id_user);
            }
            return $query->where('user_id', $user->id_user)
                ->where('visibility', 'public');
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id_user)
                ->where('visibility', 'public');
        })->get();

        $albums = Album::when(auth()->check(), function ($query) use ($user) {
            if (auth()->user()->id_user === $user->id_user) {
                return $query->where('user_id', $user->id_user)
                    ->orWhere('visibility', 'public');
            }
            return $query->where('user_id', $user->id_user)
                ->where('visibility', 'public');
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id_user)
                ->where('visibility', 'public');
        })->get();

        if ($this->isApiRequest($request)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'photos' => $photos,
                    'albums' => $albums,
                ],
            ], 200);
        }

        return view('profile.show', compact('user', 'photos', 'albums'));
    }
}
