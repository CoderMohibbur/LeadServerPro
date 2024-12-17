<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index');
    }
    public function getUsers()
    {
        $users = User::select(['id', 'name', 'email', 'created_at']);
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

}

