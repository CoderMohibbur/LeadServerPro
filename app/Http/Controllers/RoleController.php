<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log; // Import the Log facade



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


    public function edit($id)
    {
        // Retrieve the role by ID
        $role = Role::findOrFail($id);

        // Return the edit view with the role data
        return view('roles.edit', compact('role'));
    }


    public function show($id)
    {
        // Retrieve the role by ID
        $role = Role::findOrFail($id);

        // Return the edit view with the role data
        return view('roles.show', compact('role'));
    }

    // public function destroy($id)
    // {
    //     // Retrieve the role by ID
    //     $role = Role::findOrFail($id);

    //     // Delete the role
    //     $role->delete();

    //     // Redirect to the roles index with a success message
    //     return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    // }
    public function destroy($id)
    {
        try {
            // Find the role by ID
            $role = Role::findOrFail($id);
    
            // Detach all permissions associated with the role
            $role->syncPermissions([]); // Detaches all permissions
            
            // Delete the role
            $role->delete();
    
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Error deleting role: " . $e->getMessage());
            return redirect()->route('roles.index')->with('error', 'Failed to delete the role.');
        }
    }
    
}