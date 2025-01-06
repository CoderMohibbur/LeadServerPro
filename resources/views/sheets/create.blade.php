<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload New Sheet') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">


        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Move the button to the right with spacing -->
            <div class="mb-4 flex justify-end space-x-4">
                
            </div>
            <form action="{{ route('sheets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <!-- File Input -->
                    <div>
                        <label for="file" class="block text-gray-700 dark:text-gray-300">Select Your Sheet:</label>
                        <input type="file" id="file" name="file" required
                            class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                        @error('file')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Working Date -->
                    <div>
                        <label for="sheet_working_date" class="block text-gray-700 dark:text-gray-300">Sheet Working
                            Date:</label>
                        <input type="date" id="sheet_working_date" name="sheet_working_date"
                            value="{{ old('sheet_working_date', now()->toDateString()) }}" required
                            class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                        @error('sheet_working_date')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sheet Name -->
                    <div>
                        <label for="sheet_name" class="block text-gray-700 dark:text-gray-300">Sheet Name:</label>
                        <input type="text" id="sheet_name" name="sheet_name" value="{{ old('sheet_name') }}" required
                            class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                        @error('sheet_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div x-data="{ open: false, search: '', selectedUser: '', selectedUserId: '' }" class="relative">
                        <label for="user_id" class="block text-gray-700 dark:text-gray-300">User:</label>

                        <!-- Input for search -->
                        <input
                            type="text"
                            x-model="search"
                            @focus="open = true"
                            @click="open = true"
                            class="w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm p-2"
                            placeholder="Search User..."
                            autocomplete="off">

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            class="absolute mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-auto rounded-md z-10">
                            <ul class="w-full py-1 text-sm text-gray-700 dark:text-gray-300">
                                @foreach ($users as $user)
                                    <li x-show="search === '' || '{{ $user->name }}'.toLowerCase().includes(search.toLowerCase())">
                                        <a href="#"
                                            class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
                                            @click.prevent="
                                                selectedUser = '{{ $user->name }}';
                                                selectedUserId = '{{ $user->id }}';
                                                open = false;">
                                            {{ $user->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Selected User -->
                        <div x-show="selectedUser" class="mt-2 text-gray-600 dark:text-gray-300">
                            <p>Selected User: <span x-text="selectedUser"></span></p>
                        </div>

                        <!-- Hidden Input for Form Submission -->
                        <input type="hidden" name="user_id" :value="selectedUserId">

                        <!-- Error handling -->
                        @error('user_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                </div>

                <div>
                    <button type="submit"
                        class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                        Upload Sheet
                    </button>
                    <a href="{{ route('sheets.index') }}"
                        class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
