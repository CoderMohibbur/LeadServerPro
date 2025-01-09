<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Handle the response after user registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request)
    {
        // Check if the user is approved
        if (Auth::user() && Auth::user()->is_approved) {
            // If the user is approved, skip logout and proceed as normal
            return redirect()->route('dashboard')->with('success', 'Welcome to your dashboard!');
        }
    
        // If the user is not approved, log them out
        Auth::logout();
    
        // Redirect to the login page with a flash message
        return redirect()->route('login')->with('error', 'Your account has been created but is pending approval.');
    }
}
