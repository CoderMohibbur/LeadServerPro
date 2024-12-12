<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
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

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'country' => $input['country'] ?? null,
            'company_name' => $input['company_name'] ?? null,
            'phone_number' => $input['phone_number'] ?? null,
            'linkedin_url' => $input['linkedin_url'] ?? null,
        ]);
    }
}
