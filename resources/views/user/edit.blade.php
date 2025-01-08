<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <!-- Form Title -->
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit User</h1>

            @if ($errors->has('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <!-- Edit User Form -->
            <form method="POST" action="{{ route('User.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Name -->
                    <div>
                        <x-label for="name" value="Name" />
                        <x-input id="name" type="text" name="name" value="{{ $user->name }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="Email" />
                        <x-input id="email" type="email" name="email" value="{{ $user->email }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <x-label for="country" value="Country" />
                        <select id="country" name="country"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="" disabled>Select Country</option>
                            <option value="United States" {{ $user->country === 'United States' ? 'selected' : '' }}>United States</option>
                            <option value="AU" {{ $user->country === 'AU' ? 'selected' : '' }}>Australia</option>
                            <option value="UK" {{ $user->country === 'UK' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="IT" {{ $user->country === 'IT' ? 'selected' : '' }}>Italy</option>
                            <option value="DE" {{ $user->country === 'DE' ? 'selected' : '' }}>Germany</option>
                            <option value="ES" {{ $user->country === 'ES' ? 'selected' : '' }}>Spain</option>
                            <option value="FR" {{ $user->country === 'FR' ? 'selected' : '' }}>France</option>
                            <option value="CA" {{ $user->country === 'CA' ? 'selected' : '' }}>Canada</option>
                        </select>
                        @error('country')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <x-label for="company_name" value="Company Name" />
                        <x-input id="company_name" type="text" name="company_name" value="{{ $user->company_name }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                        @error('company_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- LinkedIn URL -->
                    <div>
                        <x-label for="linkedin_url" value="LinkedIn URL" />
                        <x-input id="linkedin_url" type="url" name="linkedin_url" value="{{ $user->linkedin_url }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                        @error('linkedin_url')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-label for="phone_number" value="Phone Number" />
                        <x-input id="phone_number" type="tel" name="phone_number" value="{{ $user->phone_number }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                        @error('phone_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('User.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                        {{ __('Cancel') }}
                    </a>
                    <x-button
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800">
                        {{ __('Save Changes') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
