<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(Request $request, $username)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userToFollow = User::where('username', $username)->firstOrFail();
        auth()->user()->followings()->attach($userToFollow->id_user);

        return response()->json(['success' => 'Followed', 'followers_count' => $userToFollow->followers()->count()]);
    }

    public function unfollow(Request $request, $username)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userToUnfollow = User::where('username', $username)->firstOrFail();
        auth()->user()->followings()->detach($userToUnfollow->id_user);

        return response()->json(['success' => 'Unfollowed', 'followers_count' => $userToUnfollow->followers()->count()]);
    }
}
