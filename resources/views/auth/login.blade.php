<x-guest-layout>
    <x-authentication-card class="dark:bg-gray-800">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <div class="flex justify-center">
            <div class="sm:max-w-md w-full">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-label for="email" value="{{ __('Email') }}" class="dark:text-white" />
                        <x-input id="email" class="block mt-1 w-full dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-4">
                        <x-label for="password" value="{{ __('Password') }}" class="dark:text-white" />
                        <x-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mb-4">
                        <label for="remember_me" class="flex items-center text-white dark:text-gray-400">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="ms-4 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-400">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
