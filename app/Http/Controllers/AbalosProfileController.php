<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AbalosProfileController extends Controller
{
    public function update(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = Auth::user();
    
    // Update user profile
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully!');
}

public function deactivate()
{
    $user = Auth::user();
    $user->status = 'inactive'; // Assuming you have a 'status' column in your users table
    $user->save();

    Auth::logout(); // Optionally logout the user after deactivation

    return redirect()->route('user.dashboard')->with('success', 'Your account has been deactivated.');
}

}
