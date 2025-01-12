<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile($uuid, Request $request)
    {
        $user = User::where('uuid', $uuid)->with('photos')->firstOrFail();

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
