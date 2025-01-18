<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }
    public function getUsers()
    {
        $users = User::select(columns: ['id', 'name', 'email', 'created_at', 'is_approved']);
        return DataTables::of($users)->make(true);
    }
    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'country' => 'nullable|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:20',
                'linkedin_url' => 'nullable|url',
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'country' => $validated['country'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
            ]);

            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            // এরর মেসেজ নিয়ে ফিরে যান
            return redirect()->back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // public function dashboard_Totalclient(){

    //     $users = User::count();

    //     return view('dashboard', compact('users'));
    // }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id); // Ensure user exists
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the user.'], 500);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);  // Find the user by ID
            return view('user.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'User not found: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // Add other fields you want to update
        ]);

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Update user data
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // Add other fields you want to update
            $user->save();

            // Redirect back to the user's page or to a success page
            return redirect()->route('User.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'User not found or update failed: ' . $e->getMessage()]);
        }
    }
    public function show($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Return a view to display the user's details
            return view('user.show', compact('user'));
        } catch (\Exception $e) {
            // If user is not found, redirect with an error message
            return redirect()->route('User.index')->withErrors(['error' => 'User not found: ' . $e->getMessage()]);
        }
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'is_approved' => 'required|boolean',
            ]);

            $record = User::findOrFail($id);
            $record->is_approved = $request->input('is_approved');
            $record->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

}

