<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_user,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => 2,
            'password' => Hash::make($validated['password']),
        ]);

        if ($this->isApiRequest($request)) {
            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } else {
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        }
    }


    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validated)) {
            if ($this->isApiRequest($request)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            } else {
                return back()->withErrors(['email' => 'Invalid credentials'])->with('error', 'Login failed! Invalid credentials.');
            }
        }

        $user = Auth::user();

        if ($this->isApiRequest($request)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        } else {
            $request->session()->regenerate();
            return redirect()->route('home.index')->with('success', 'Login successful! Welcome back, ' . $user->name . '.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout successful. See you next time!');
    }
}
