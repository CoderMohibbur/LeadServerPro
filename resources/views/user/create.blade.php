<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users List') }}
        </h1>
    </x-slot>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

            {{-- <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200"></h1>
                <a href="/User/create"
                    class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Create
                </a>
            </div> --}}
            {{-- <div id="custom-buttons" class="custom-buttons mb-4"></div> <!-- Custom Buttons Container --> --}}

            <form method="POST" action="{{ route('User.store') }}" class="space-y-8">
                @csrf

                <div class=" grid grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input id="name" name="name" type="text" placeholder="Full Name"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" name="email" type="email" placeholder="example@mail.com"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input id="password" name="password" type="password" placeholder="******"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="******"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                        <select id="country" name="country"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
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
                        <label for="company_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company
                            Name</label>
                        <input id="company_name" name="company_name" type="text" placeholder="Company Name"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('company_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- LinkedIn URL -->
                    <div>
                        <label for="linkedin_url"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
                        <input id="linkedin_url" name="linkedin_url" type="url"
                            placeholder="https://www.linkedin.com/in/example"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('linkedin_url')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone_number"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone
                            Number</label>
                        <input id="phone_number" name="phone_number" type="tel" placeholder="+1234567890"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('phone_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Actions -->
                <div class="flex items-center mt-8 space-x-2">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                        {{ __('Create') }}
                    </button>
                    <button
                        type="button"
                        onclick="window.location.href='{{ route('User.index') }}'"
                        class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Back to List
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
