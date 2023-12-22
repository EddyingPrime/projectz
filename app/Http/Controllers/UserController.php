<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'default-avatar-profile.jpg',
            'cover_image' => 'default-cover-image.jpg',
        ]);

    
        return response()->json(['user' => $user], 201);
    }

// Login
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean', 
    ]);

    if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $user = $request->user();

    // Always create a new token during login
    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json(['token' => $token, 'user' => $user]);
}


    // Logout
    public function logout(Request $request)
    {
        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();
    
        return response()->json(['message' => 'Logged out successfully']);
    }

    // User Profile
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user]);
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the request data
    $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update name and email
    $user->name = $request->input('name', $user->name);
    $user->email = $request->input('email', $user->email);

    // Handle profile image update
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarFilename = $avatar->getClientOriginalName();
        $avatar->storeAs('avatar', $avatarFilename);
        $user->avatar = $avatarFilename;
    }

    // Handle cover image update
    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageFilename = $coverImage->getClientOriginalName();
        $coverImage->storeAs('cover_image', $coverImageFilename);
        $user->cover_image = $coverImageFilename;
    }

    // Save changes to the database
    $user->save();

    // Return the updated user data in the response
    return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
}
}