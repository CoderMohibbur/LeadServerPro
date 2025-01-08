<!-- resources/views/user/show.blade.php -->
<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg my-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">User Details</h1>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Name:</label>
            <p class="text-gray-800">{{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email:</label>
            <p class="text-gray-800">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <label for="created_at" class="block text-gray-700 font-semibold">Created At:</label>
            <p class="text-gray-800">{{ $user->created_at->format('F d, Y') }}</p>
        </div>

        <div class="mb-4">
            <label for="updated_at" class="block text-gray-700 font-semibold">Updated At:</label>
            <p class="text-gray-800">{{ $user->updated_at->format('F d, Y') }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <!-- Updated route names here -->
            <a href="{{ route('User.index') }}" class="text-blue-500 hover:underline">Back to Users List</a>
            <a href="{{ route('User.edit', $user->id) }}" class="text-yellow-500 hover:underline">Edit User</a>
        </div>
    </div>
</x-app-layout>
