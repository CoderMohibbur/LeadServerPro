<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        $permissions = Permission::all(); // Fetch all permissions

        return view('roles.index', compact('roles', 'permissions')); // Pass both roles and permissions to the view
    }

    public function create()
    {
        $permissions = Permission::all(); // Fetch all permissions
        return view('roles.create', compact('permissions')); // Pass permissions to the create view
    }

    public function store(Request $request)
    {
        // Validate role and permissions
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        // Create new role
        $role = Role::create(['name' => $request->name]);

        // Assign selected permissions to the role
        $role->givePermissionTo($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }
}