<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return User
     */
    public function create(array $input): User
    {
        // Validate input
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'country' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url',
        ])->validate();

        // Create the user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'country' => $input['country'] ?? null,
            'company_name' => $input['company_name'] ?? null,
            'phone_number' => $input['phone_number'] ?? null,
            'linkedin_url' => $input['linkedin_url'] ?? null,
            'is_approved' => false, // Automatically set to false
        ]);

        // Assign the default "Customer" role to the new user
        $user->assignRole('Customer'); // Ensure the "Customer" role exists in your database

        // Fire the Registered event
        event(new Registered($user));

        // Log out the user immediately after registration
        Auth::logout();

        // Flash a message to inform the user
        session()->flash('error', 'Your account has been created but is pending approval.');

        // Return the user object (required by Fortify)
        return $user;
    }
}
