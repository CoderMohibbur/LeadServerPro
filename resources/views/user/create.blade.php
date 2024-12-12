<x-app-layout>




    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sheet Lists') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <!-- Form Title -->
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Register</h1>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('User.store') }}" class="space-y-6">
                @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Name -->
                    <div>
                        <x-label for="name" value="Name" />
                        <x-input id="name" type="text" name="name" placeholder="Full Name"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="Email" />
                        <x-input id="email" type="email" name="email" placeholder="example@mail.com"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <x-label for="password" value="Password" />
                        <x-input id="password" type="password" name="password" placeholder="******"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-label for="password_confirmation" value="Confirm Password" />
                        <x-input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="******"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                            @error('password_confirmation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <x-label for="country" value="{{ __('Country') }}" />
                        <select id="country" name="country"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option selected>United States</option>
                            <option value="AU">Australia</option>
                            <option value="UK">United Kingdom</option>
                            <option value="IT">Italy</option>
                            <option value="DE">Germany</option>
                            <option value="ES">Spain</option>
                            <option value="FR">France</option>
                            <option value="CA">Canada</option>
                        </select>
                        @error('country')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <x-label for="company_name" value="{{ __('Company Name') }}" />
                        <x-input id="company_name" class="block w-full text-sm p-2 border border-gray-300 rounded"
                            type="text" name="company_name" placeholder=" Company Name "
                            value="92 Miles Drive, Newark, NJ 07103" required />
                        @error('company_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- LinkedIn URL -->
                    <div>
                        <x-label for="linkedin_url" value="{{ __('LinkedIn URL') }}" />
                        <x-input id="linkedin_url" class="block w-full text-sm p-2 border border-gray-300 rounded"
                            type="url" name="linkedin_url" placeholder="LinkedIn URL"
                            value="https://www.linkedin.com/in/helene-example/" required />

                        @error('linkedin_url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-label for="phone_number" value="Phone Number" />
                        <x-input id="phone_number" type="tel" name="phone_number" placeholder="+1234567890"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                            @error('phone_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                        {{ __('Already registered?') }}
                    </a>
                    <x-button
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800">
                        {{ __('Save') }}
                    </x-button>

                </div>
            </form>




        </div>
    </div>

</x-app-layout>
