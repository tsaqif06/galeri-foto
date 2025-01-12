<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile($username, Request $request)
    {
        $user = User::where('username', $username)->with('photos')->firstOrFail();

        if ($this->isApiRequest($request)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'photos' => $user->photos,
                ],
            ], 200);
        }

        return view('profile.show', compact('user'));
    }
}
