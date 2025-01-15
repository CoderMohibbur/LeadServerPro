<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard_TotalLead(Request $request) {
        $user = Auth::user(); // Explicitly retrieve the authenticated user
        if (!$user) {
            return redirect()->route('login'); // Handle unauthenticated users
        }

        if ($request->user()->hasRole('admin')) {
            // Code for 'admin' role
            $leads = Lead::count();
            $users = User::count();
            $sheets = Sheet::count();
            $tickets = Ticket::count();
            return view('dashboard', compact('leads','users','sheets','tickets'));

        } elseif ($request->user()->hasRole('user')) {

            $leads = Lead::whereHas('sheet', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();

            $users = User::where('id', $user->id)->count();
            $sheets = Sheet::where('user_id', $user->id)->count();
            $tickets = Ticket::where('user_id', $user->id)->count();

            return view('dashboard', compact('leads', 'users', 'sheets', 'tickets'));
        } else {
            // Code for other roles or unauthorized access
            return response()->json(['message' => 'Access Denied.'], 403);
        }


    }

}
