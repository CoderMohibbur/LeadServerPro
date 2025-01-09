<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    /**
     * Display the users and their roles.
     */
    public function index()
    {
        // Fetch all users with their roles
        $users = User::with('roles')->get();

        // Fetch all available roles
        $roles = Role::all();

        return view('role-management.index', compact('users', 'roles'));
    }

    /**
     * Update the roles of a user.
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'roles' => 'nullable|array',
        ]);

        // Find the user
        $user = User::findOrFail($request->user_id);

        // Sync roles (replace current roles with selected ones)
        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Roles updated successfully!');
    }
}