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
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat User Baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($this->isApiRequest($request)) {
            // API Response
            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } else {
            // Redirect untuk Web
            return redirect('/login')->with('success', 'Registration successful. Please login.');
        }
    }

    public function login(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validated)) {
            if ($this->isApiRequest($request)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            } else {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }
        }

        $user = Auth::user();

        if ($this->isApiRequest($request)) {
            // API Response
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        } else {
            // Redirect untuk Web
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
