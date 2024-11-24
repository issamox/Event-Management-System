<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Apply optional filters for role and reservation status
        $query = User::with('reservations');

        // Filter by role if specified
        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Filter by reservation status if specified
        if ($request->has('reservations')) {
            if ($request->reservations === 'with-reservations') {
                $query->has('reservations');
            } elseif ($request->reservations === 'no-reservations') {
                $query->doesntHave('reservations');
            }
        }

        // Paginate the results
        $users = $query->paginate(10)->withQueryString();

        // Pass filters back to the view for persisting UI state
        return view('users.index', [
            'users' => $users,
            'filters' => [
                'role' => $request->role ?? 'all',
                'reservations' => $request->reservations ?? 'all',
            ],
        ]);
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
