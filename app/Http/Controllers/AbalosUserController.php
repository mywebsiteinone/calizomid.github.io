<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AbalosUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('abaloschristianuser', compact('users', 'search'));
    }

    public function create()
    {
        return view('abaloschristianuser', ['editUser' => null]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|max:50',
        'status' => 'required|string|max:20' // Add validation for status
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'status' => $request->status // Store status
    ]);

    return redirect()->route('abalos-users.index')->with('success', 'User created successfully.');
}


    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('abalos-users.index')->with('error', 'User not found.');
        }

        return view('abaloschristianuser', ['editUser' => $user]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|string|max:50',
        'status' => 'required|string|max:20' // Add validation for status
    ]);

    $user = User::find($id);
    if ($user) {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'status' => $request->status // Update status
        ]);
    }

    return redirect()->route('abalos-users.index')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->route('abalos-users.index')->with('success', 'User deleted successfully.');
    }
}
