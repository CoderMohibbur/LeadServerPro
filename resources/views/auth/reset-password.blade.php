<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}" class="max-w-sm mx-auto bg-white p-4 rounded-md shadow-md">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="space-y-3">
                <!-- Email Field -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-sm" />
                    <x-input id="email" class="block mt-1 w-2/3 mx-auto p-1 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <!-- Password Field -->
                <div>
                    <x-label for="password" value="{{ __('Password') }}" class="text-sm" />
                    <x-input id="password" class="block mt-1 w-2/3 mx-auto p-1 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-sm" />
                    <x-input id="password_confirmation" class="block mt-1 w-2/3 mx-auto p-1 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-button class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
