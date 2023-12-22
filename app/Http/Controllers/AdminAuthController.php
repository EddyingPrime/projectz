<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    // Admin Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', 
            'avatar' => 'default-avatar-profile.jpg',
            'cover_image' => 'default-cover-image.jpg',
        ]);

        return response()->json(['admin' => $admin], 201);
    }

    // Admin Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $admin = $request->user();

        // Always create a new token during login
        $token = $admin->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token, 'admin' => $admin]);
    }
}