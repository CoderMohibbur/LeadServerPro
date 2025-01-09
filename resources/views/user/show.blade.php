<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h1>
    </x-slot>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold">Name:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->name }}</p>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold">Email:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->email }}</p>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold">Phone Number:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->phone_number }}</p>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold">Country:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->country }}</p>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold">Company:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->company_name }}</p>
            </div>

            <div class="mb-4">
                <label for="created_at" class="block text-gray-700 dark:text-gray-300 font-semibold">Created At:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->created_at->format('F d, Y') }}</p>
            </div>
            
            <div class="mb-4">
                <label for="updated_at" class="block text-gray-700 dark:text-gray-300 font-semibold">Updated At:</label>
                <p class="text-gray-800 dark:text-gray-100">{{ $user->updated_at->format('F d, Y') }}</p>
            </div>
            
            <div class="flex mt-6 space-x-4">
                <a href="{{ route('User.edit', $user->id) }}" 
                   class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Edit User
                </a>
                <a href="{{ route('User.index') }}" 
                   class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Back to List
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
