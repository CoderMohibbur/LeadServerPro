<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Sheet') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Create New Sheet Link -->
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Create New Sheet</h1>
                <a href="{{ route('sheet-lists.index') }}"
                    class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Back to Sheet Lists
                </a>
            </div>

            <!-- Create Sheet Form -->
            <form action="{{ route('sheet-lists.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                <!-- File Input -->
                <div>
                    <label for="file" class="block text-gray-700 dark:text-gray-300">Select Your Sheet:</label>
                    <input type="file" id="file" name="file" value="{{ old('file') }}" required
                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm border-gray-700">
                    @error('file')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sheet Working Date -->
                <div>
                    <label for="sheet_working_date" class="block text-gray-700 dark:text-gray-300">Sheet Working
                        Date:</label>
                    <input type="date" id="sheet_working_date" name="sheet_working_date"
                    value="{{ old('sheet_working_date', now()->toDateString()) }}"  required
                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                    @error('sheet_working_date')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sheet Name -->
                <div>
                    <label for="sheet_name" class="block text-gray-700 dark:text-gray-300">Sheet Name:</label>
                    <input type="text" id="sheet_name" name="sheet_name" value="{{ old('sheet_name') }}" required
                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                    @error('sheet_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- User Selection -->
                <div>
                    <label for="user_id" class="block text-gray-700 dark:text-gray-300">User:</label>
                    <select id="user_id" name="user_id" required
                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                        Create Sheet
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
