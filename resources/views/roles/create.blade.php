<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Role') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div >
                        <label for="name" class="block text-gray-700 dark:text-gray-200 font-semibold">Role
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-800 dark:text-gray-200 dark:ring-indigo-600 @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div >
                        <label for="permissions" class="block text-gray-700 dark:text-gray-200 font-semibold">Assign
                            Permissions</label>
                        <select name="permissions[]" id="permissions"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-800 dark:text-gray-200 dark:ring-indigo-600"
                            multiple required>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Create Role
                </button>
                <a href="{{ route('roles.index') }}" class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</x-app-layout>
