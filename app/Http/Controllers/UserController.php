<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::with('reservations')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        // Create and save the user
         User::create($request->validated());
        // Redirect to the users list page with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    public function update(updateuserrequest $request, User $user)
    {

        // Only hash and update password if a new password is provided
        $data = $request->only(['name', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Update user
        $user->update($data);

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        try {
            // Delete the user
            $user->delete();

            // Redirect back with success message
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions and return an error message
            return redirect()->route('users.index')->with('error', 'Failed to delete user. Please try again.');
        }
    }


}
