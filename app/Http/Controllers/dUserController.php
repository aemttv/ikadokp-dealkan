<?php

namespace App\Http\Controllers;

use App\Models\d_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class dUserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'noHP' => 'required|string|max:15',
            'noWA' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        d_User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'noHP' => $request->noHP,
            'noWA' => $request->noWA,
            'password' => bcrypt($request->password),
            'status' => 1, // default status
        ]);

        return redirect()->back()->with('success', 'User added successfully!');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        // Find the user by email
        $user = d_User::where('email', $request->email)->first();

        // Check if user exists and the password is correct
        if ($user) {
            // Use Hash::check to verify the password
            $passwordMatches = Hash::check($request->password, $user->password);

            if ($passwordMatches) {
                // Log the user in
                Auth::loginUsingId($user->id); // You can also use Auth::login($user);
                return redirect()->intended('/homeLogin')->with('success', 'You are signed in!');
            } else {
                return back()->with('error', 'Invalid credentials.')->withInput();
            }
        }

        // If login fails, redirect back with an error
        return back()->with('error', 'Invalid credentials.')->withInput();
    }
}
